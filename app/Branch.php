<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    // 
    protected $fillable = ['latitude', 'longitude', 'region', 'branch', 'branchName'];

    protected $hidden = ['password'];
}
