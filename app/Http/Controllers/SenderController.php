<?php

namespace App\Http\Controllers;
use App\Sender;
use App\User;
use App\RequestDelivery;
use App\Http\Requests;
use App\Http\Requests\RequestDeliveryRequest;
use Validator;
use Auth;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Input;
class SenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function getPage()
    {
        $sender_id = Auth::user()->userid;
        $receivers = RequestDelivery::where('sender_id',$sender_id)->where('status','Pending')->get();
        return view('pages.sender_home')->with('receivers', $receivers);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'senderAddress' => 'required|max:255',
            'senderContact' => 'required|min:11|numeric'
        ]);
    }

 
    protected function create(array $data)
    {
        return Sender::create([
            'senderAddress' => $data['senderAddress'],
            'senderContact' => $data['senderContact']
        ]);


    }
}

