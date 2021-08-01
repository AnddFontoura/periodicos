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
                $table->unsignedBigInteger('subcategory_id');
                $table->string('name',200);
                $table->string('path',1000);
                $table->text('authors');
                $table->text('resume');
                $table->text('abstract');
                $table->integer('pages')->default(0);
                $table->text('keywords');
                $table->text('image')->nullable(true);
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('subcategory_id')->references('id')->on('sub_categories');
            });
        } catch (Exception $e) {
            Schema::dropIfExists('articles');
            dd($e->getMessage());
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
