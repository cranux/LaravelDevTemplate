<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Image.
 *
 * @package namespace App\Models;
 */
class Image extends Model implements Transformable
{
    use TransformableTrait;

    protected $table='images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image', 'sort', 'status'
    ];
    /**
     * 状态
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<label class="badge bg-warning">禁用</label>';
        }
        if ($this->status == 1) {
            return '<label class="badge bg-primary">显示</label>';
        }

        return '';
    }

    /**
     * 操作按钮.
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getEditButtonAttribute().
            $this->getDeleteButtonAttribute();
    }

    /**
     * 编辑文章.
     * @return string
     */
    protected function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.image.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
    }

    /**
     * 删除文章.
     * @return string
     */
    protected function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.image.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="取消"
             data-trans-button-confirm="删除"
             data-trans-title="你确定要这么做吗?"
             data-trans-text="图片删除后将不能恢复"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除" style="color: #fff"></i></a> ';
    }



}
