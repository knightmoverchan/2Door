<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['messenger_id','latitude', 'longitude'];
    
}
