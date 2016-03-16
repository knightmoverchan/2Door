<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedArea extends Model
{
	protected $table = 'assignedarea';
    protected $fillable = ['latitude', 'longitude', 'area', 'branch', 'assigned'];

    protected $hidden = ['password', 'remember_token'];
}
