<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    protected $fillable = ['plateNo', 'address', 'contact', 'assignedArea','picture'];

    protected $hidden = ['password'];
}
