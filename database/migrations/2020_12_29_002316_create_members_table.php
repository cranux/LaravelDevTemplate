<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Jialeo\LaravelSchemaExtend\Schema as Schema_;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema_::create('members', function (Blueprint $table) {
            $table->id('id');
            $table->integer('inviter_id')->comment('邀请人');
            $table->string('wx_unionid');
            $table->string('wx_openid');
            $table->string('nickname')->default('')->comment('昵称');
            $table->tinyInteger('sex')->default(0)->comment('性别  0未知 1男 2女');
            $table->decimal('credit1')->default(0.00)->comment('余额');
            $table->integer('credit2')->default(0)->comment('积分');
            $table->string('head_img_url')->default('')->comment('头像');
            $table->timestamps();
            $table->unique('wx_unionid', 'wx_unionid');
//            $table->index(['inviter_id', 'wx_unionid', 'wx_openid']);
            $table->index('inviter_id');
            $table->index('wx_unionid');
            $table->index('wx_openid');
            $table->comment = '用户';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
