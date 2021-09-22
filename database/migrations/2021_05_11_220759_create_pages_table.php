<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('pages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name',100);
                $table->text('description');
                $table->boolean('home_page')->default(0);
                $table->timestamps();
                $table->softDeletes();
            });
        } catch (Exception $e) {
            Schema::dropIfExists('pages');
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
        Schema::dropIfExists('pages');
    }
}
