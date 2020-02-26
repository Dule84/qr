<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchandisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proiz');
            $table->string('country');
            $table->string('uvoznik');
            $table->string('name');
            $table->string('sastav');
            $table->string('size');
            $table->string('maintenance');
            $table->string('slug');
            $table->string('qr_name');
            $table->unsignedInteger('user_id')->index();
            $table->timestamps();
        });

        Schema::table('merchandises', function($table) {
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandises');
    }
}
