<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Jialeo\LaravelSchemaExtend\Schema as Schema_;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema_::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('管理员');
            $table->string('title')->comment('文章标题');
            $table->string('thumbnail')->nullable()->comment('缩略图');
            $table->text('content')->nullable()->comment('内容');
            $table->timestamps();
            $table->index(['user_id']);
            $table->comment = '文章';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
