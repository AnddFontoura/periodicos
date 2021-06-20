<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('sub_categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 200);
                $table->text('description', 1000);
                $table->text('image');
                $table->timestamps();
                $table->softDeletes();
            });
        } catch (Exception $e) {
            Schema::dropIfExists('sub_categories');
        }   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
