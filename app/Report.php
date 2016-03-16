<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['transaction_id','description'];
 
}
