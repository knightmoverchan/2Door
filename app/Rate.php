<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //
		protected $primaryKey = 'type';
     protected $fillable = ['weight', 'cost', 'excess', 'ecost'];

    protected $hidden = ['password'];
}
