<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('fname',20);
            $table->string('lname',20);
            $table->string('email',60)->unique();
            $table->string('password',60);
            $table->string('userid');
            $table->string('user_type');
            $table->string('area')->nullable();
            $table->string('branch')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
