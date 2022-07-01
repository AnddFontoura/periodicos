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
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('name',1000);
            $table->string('path',1000)->nullable(true);
            $table->text('authors')->nullable(true);
            $table->text('resume')->nullable(true);
            $table->text('abstract')->nullable(true);
            $table->integer('pages')->default(0);
            $table->text('keywords')->nullable(true);
            $table->text('image')->nullable(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('SET NULL');
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
