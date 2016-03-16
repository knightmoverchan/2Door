<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('messenger_id')->unsigned();
            $table->foreign('messenger_id')->references('id')->on('messengers')->onDelete('cascade');
            $table->string('latitude',100);
            $table->string('longitude',100);
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
        //
    }
}
