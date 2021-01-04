<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Jialeo\LaravelSchemaExtend\Schema as Schema_;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema_::create('settings', function (Blueprint $table) {
            $table->id('id');
            $table->integer('user_id');
            $table->text('mini_program')->nullable()->comment('小程序设置');
            $table->text('wechat')->nullable()->comment('微信公众号设置');
            $table->text('payment')->nullable()->comment('支付设置');
            $table->text('other')->nullable()->comment('其他设置');
            $table->timestamps();
            $table->index(['user_id']);
            $table->comment = '系统设置';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
