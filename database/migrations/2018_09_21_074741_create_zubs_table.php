<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zubs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pregled_id');
            $table->unsignedInteger('oznaka');
            $table->string('napomena')->nullable();
            $table->string('pozicija')->nullable();
            $table->string('lijekovi')->nullable();
            $table->timestamps();

            $table->foreign('pregled_id')->references('id')->on('pregleds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zubs');
    }
}
