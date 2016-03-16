<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('transactions', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('transactionid')->references('id')->on('receivers')->onDelete('cascade');
            $table->string('type');
            $table->string('receiverFname');
            $table->string('receiverLname');
            $table->string('senderid');
            $table->string('description');
            $table->string('latitude');
            $table->string('longitude');    
            $table->string('receivercontact');
            $table->string('sendercontact');
            $table->string('weight');
            $table->string('cost');
            $table->string('address');
            $table->string('branch');
            $table->string('branchName');
            $table->string('area');
            $table->string('assign');
            $table->string('areaOrigin');
            $table->string('branchOrigin');
            $table->string('status')->default('Pending');
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
