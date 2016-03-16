<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDelivery extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id';
    protected $fillable = ['receiverFname', 'receiverLname', 'sender_id','receiverAddress', 'originBranch','originArea','latitude','longitude', 'receiverContact','packType', 'status'];
}
