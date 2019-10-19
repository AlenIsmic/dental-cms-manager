<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinskiKartonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinski_kartons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('klijent_id');
            $table->string('krvna_grupa')->nullable();
            $table->string('alergije')->nullable();
            $table->string('trenutne_bolesti')->nullable();
            $table->timestamps();

            $table->foreign('klijent_id')->references('id')->on('klijents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicinski_kartons');
    }
}
