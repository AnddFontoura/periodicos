<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('subcategory_id');
                $table->string('name',200);
                $table->text('description');
                $table->text('image');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('subcategory_id')->references('id')->on('sub_categories');
            });
        } catch (Exception $e) {
            Schema::dropIfExists('categories');
        }   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
