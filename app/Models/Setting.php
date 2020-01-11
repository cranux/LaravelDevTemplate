<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Setting.
 *
 * @package namespace App\Models;
 */
class Setting extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'mini_program' => 'json',
        'wechat' => 'json',
        'other' => 'json',
        'payment' => 'json',
    ];

}
