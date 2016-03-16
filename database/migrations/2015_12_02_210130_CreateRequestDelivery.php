<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('receiverFname',20);
            $table->string('receiverLname',20);
            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('senders')->onDelete('cascade');
            $table->string('receiverAddress',255);
            $table->string('originBranch',100);
            $table->string('originArea',100);
            $table->string('status', 100)->default('Pending');
            $table->string('latitude',100);
            $table->string('longitude',100);
            $table->string('receiverContact',20);
            $table->string('packType',20);
            $table->string('description',100);
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
