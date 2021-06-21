<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('articles', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name',200);
                $table->text('path',1000);
                $table->text('authors');
                $table->text('resume');
                $table->text('abstract');
                $table->integer('pages');
                $table->text('keywords');
                $table->text('image')->nullable(true);
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('category_id')->references('id')->on('categories');
            });
        } catch (Exception $e) {
            Schema::dropIfExists('articles');
        }   
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
