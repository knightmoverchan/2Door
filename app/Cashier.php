<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    //
    protected $fillable = ['address', 'contact','picture'];

    protected $hidden = ['password'];
}

	