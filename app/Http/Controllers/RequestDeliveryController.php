<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestDeliveryRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RequestDelivery;
use Auth;
use App\Branch;
use Redirect;

class RequestDeliveryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function create()
    {
        $sender_id = Auth::user()->userid;
        $branches = Branch::all();
        return view('pages.request_form')->with('sender_id',$sender_id)->with('branches', $branches);
    }

   
    public function store(RequestDeliveryRequest $data)
    {
        $receiver = new RequestDelivery();
        $receiver->receiverFname = $data['receiverFname'];
        $receiver->receiverLname = $data['receiverLname'];
        $receiver->sender_id = $data['sender_id'];
        $receiver->receiverAddress = $data['receiverAddress'];
        $receiver->latitude = $data['latitude'];
        $receiver->longitude = $data['longitude'];
        $receiver->originBranch = $data['originBranch'];
        $receiver->originArea = $data['originArea'];
        $receiver->description = $data['description'];
        $receiver->receiverContact = $data['receiverContact'];
        $receiver->packType = $data['packType'];
        $receiver->save();

        return Redirect::to('/senderHome'); 
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $receiver = RequestDelivery::find($id);

        return view('pages.edit_receiver')->with('results', $receiver);
    }

    
    public function update(RequestDeliveryRequest $data, $id)
    {
        $receiver = RequestDelivery::find($id);
        $receiver->receiverFname = $data['receiverFname'];
        $receiver->receiverLname = $data['receiverLname'];
        $receiver->sender_id = $data['sender_id'];
        $receiver->receiverAddress = $data['receiverAddress'];
        $receiver->latitude = $data['latitude'];
        $receiver->longitude = $data['longitude'];
        $receiver->originBranch = $data['originBranch'];
        $receiver->originArea = $data['originArea'];
        $receiver->receiverContact = $data['receiverContact'];
        $receiver->packType = $data['packType'];
        $receiver->description = $data['description'];
        $receiver->save();

        return Redirect::to('/senderHome');
    }

   
    public function destroy($id)
    {
        $receiver = RequestDelivery::find($id);
        $receiver->delete();
        return Redirect::to('/senderHome');
    }
}
