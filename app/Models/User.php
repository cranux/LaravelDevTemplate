<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Transformable
{

    use Notifiable,
        TransformableTrait,
        HasRoles;

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * https://laravel-china.org/docs/laravel/5.5/eloquent-mutators
     * 获取当前用户所属角色.
     * @return string
     */
    public function getRoleNameAttribute()
    {
        $roles = $this->getRoleNames(); // Returns a collection
        $string = '';
        foreach ($roles as $role) {
            $string .= "<label class='label label-success'>{$role}</label>";
        }

        if ($string == '') {
            $string = "<label class='label label-info'>无</label>";
        }

        return $string;
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
     * 用户详情.
     * @return string
     */
    protected function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.user.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="查看详情"></i></a> ';
    }

    /**
     * 编辑用户.
     * @return string
     */
    protected function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.user.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
    }

    /**
     * 删除用户.
     * @return string
     */
    protected function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.user.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="取消"
             data-trans-button-confirm="删除"
             data-trans-title="你确定要这么做吗?"
             data-trans-text="用户删除后将不能恢复"
             class="btn btn-xs btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="删除" style="color: #fff"></i></a> ';
    }
}
