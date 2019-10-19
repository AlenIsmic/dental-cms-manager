<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ZubDijagnoze extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zub_dijagnoze', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('zub_id');
            $table->unsignedInteger('dijagnoza_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zub_dijagnoze');
    }
}
