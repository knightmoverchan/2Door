<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSender extends Migration
{
   public function up()
    {
        Schema::create('senders', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('senderAddress',20);
            $table->string('senderContact',20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('senders');
    }
}
