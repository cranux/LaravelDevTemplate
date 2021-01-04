<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jialeo\LaravelSchemaExtend\Schema as Schema_;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema_::create('images', function (Blueprint $table) {
            $table->id('id');
            $table->integer('user_id');
            $table->string('image')->nullable()->comment('图片');
            $table->integer('sort')->default(1)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 0禁用 1启用');
            $table->timestamps();
            $table->index(['user_id']);

            $table->comment = '图片管理';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
