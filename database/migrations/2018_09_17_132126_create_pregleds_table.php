<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePregledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregleds', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('medicinski_karton_id');
            $table->date('datum');
            $table->string('napomena')->nullable();
            $table->string('placeno');
            $table->string('cijena');
            $table->timestamps();

            $table->foreign('medicinski_karton_id')->references('id')->on('medicinski_kartons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *ph
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregleds');
    }
}
