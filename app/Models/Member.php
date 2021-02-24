<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Member extends Model implements AuthenticatableContract,JWTSubject,Transformable
{
    use Authenticatable,
        TransformableTrait,
        HasFactory;
    /**
     * @var string
     */
    protected $table = 'members';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * 内关联.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inviter()
    {
        return $this->belongsTo('App\Models\Member', 'inviter_id');
    }


    /**
     * 性别.
     * @return string
     */
    public function getSexLabelAttribute()
    {
        if ($this->sex == 0) {
            return '<label class="label label-warning">未知</label>';
        }
        if ($this->sex == 1) {
            return '<label class="label label-primary">男</label>';
        }
        if ($this->sex == 2) {
            return '<label class="label label-success">女</label>';
        }

        return '';
    }

    /**
     * 获取会员头像和昵称.
     * @return string
     */
    public function getMemberAvatarAttribute()
    {
        $headimgurl = "<img src='{$this->head_img_url}' width='20' height='20'/>";
        $nickname = "<a href='".route('admin.member.index', ['member_id' => $this])."'>".$this->nickname.'</a>';

        return $headimgurl.'  '.$nickname;
    }

    /**
     * 获取邀请人头像和昵称.
     * @return string
     */
    public function getInviterAvatarAttribute()
    {
        if ($this->inviter == null) {
            return "<label class='label label-success'>无<label>";
        }
        $headimgurl = "<img src='{$this->inviter->head_img_url}' width='20' height='20'/>";
        $nickname = "<a href='".route('admin.member.index', ['inviter_id' => $this->inviter])."'>".$this->inviter->nickname.'</a>';

        return $headimgurl.'  '.$nickname;
    }

    /**
     * 操作按钮.
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getShowButtonAttribute().
            $this->getEditButtonAttribute().
            $this->getDeleteButtonAttribute();
    }

    /**
     * 会员详情.
     * @return string
     */
    protected function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.member.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="查看详情"></i></a> ';
    }

    /**
     * 编辑会员.
     * @return string
     */
    protected function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.member.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
    }

    /**
     * 删除用户.
     * @return string
     */
    protected function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.member.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="取消"
             data-trans-button-confirm="删除"
             data-trans-title="你确定要这么做吗?"
             data-trans-text="用户删除后将不能恢复"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除" style="color: #fff"></i></a> ';
    }
}
