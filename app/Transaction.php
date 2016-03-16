<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = 'transactions';
   
    protected $fillable = ['transactionid', 'weight', 'cost', 'address', 
    						'sendercontact', 'receivercontact', 'latitude', 'longitude',
    						'branch','branchName', 'receiverFname', 'receiverLname', 'senderid', 'description', 'areaOrigin', 'branchOrigin','status', 'area', 'assign'];
} 
