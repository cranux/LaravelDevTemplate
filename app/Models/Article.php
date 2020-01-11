<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Article.
 *
 * @package namespace App\Models;
 */
class Article extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'thumbnail', 'content',
    ];

    /**
     * 内关联.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
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
        return '<a href="'.route('admin.article.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
    }

    /**
     * 删除文章.
     * @return string
     */
    protected function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.article.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="取消"
             data-trans-button-confirm="删除"
             data-trans-title="你确定要这么做吗?"
             data-trans-text="文章删除后将不能恢复"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除" style="color: #fff"></i></a> ';
    }

}
