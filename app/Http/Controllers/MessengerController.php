<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use Input;
use App\Rate;
use App\Messenger;
use App\User;
use App\RequestDelivery;
use App\Transaction;
use App\Track;
use App\Branch;
use App\AssignedArea;
use App\Http\Requests\MessengerValidation;
use App\Http\Controllers\Controller;
use Redirect;

class MessengerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function create()
    {
        return view('pages.admin');
    }

    protected function rates() 
    {
        $rate = DB::table('rates')->get();

        return view('pages.rates', compact('rate'));
    }
    public function route()
    {
        $address = Transaction::all();
        $id = Auth::user()->userid;
        $br = Auth::user()->branch;
        $area = Auth::user()->area;
        $user = User::where('userid', '=', $id )->get();
        $branch = Branch::all();
        $msg = Messenger::where('id', '=', $id)->get();
        $assigned = AssignedArea::all();
        $trans = Transaction::where('branch', '=', $br)->where('area', '=', $area)->get();
        $assignedArea = AssignedArea::where('branch', '=', $br)->where('area', '=', $area)->get();
        $trans1 = Transaction::where('branch', '=', $br)->where('area', '=', $area)->get();
    
        return view('pages.messenger')->with('assignedArea', $assignedArea)->with('assigned', $assigned)->with('msg', $msg)->with('address', $address)->with('user', $user)->with('branch', $branch)->with('trans', $trans)->with('trans1', $trans1);
    }

    protected function rates2()
    {
        $rate = Rate::all();
        return view('pages.rates2', compact('rate'));
    }

    protected function changerate(Request $request, $type)   
    {
        $change = Rate::where('type', '=', $type)->first();    
        $change->rate = $request->input('rate');
        $change->excess = $request->input('excess');
        $change->weight = $request->input('weight');
        $change->ecost = $request->input('ecost');

        $change->save();


        $rate = Rate::all();
        return view('pages.rates', compact('rate'));
    
    }

    protected function listMessenger()
    {
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $messenger = User::where('user_type', "Messenger")->where('branch',$branch)->where('area',$area)->get();
        $msgName = "";
        $msgAssign = "";
        $msg = Messenger::all();
        $transactions = "";
        $senderNames = "";      
        return view('pages.allMessenger')->with('messenger', $messenger)->with('msg', $msg)->with('transactions', $transactions)->with('senderNames', $senderNames)->with('msgAssign', $msgAssign);
    } 

    protected function showAssign($id)
    {
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $messenger = User::where('user_type', "Messenger")->where('branch',$branch)->where('area',$area)->get();
        $msgAssign = Messenger::where('id', $id)->first();
        $msgName = User::where('user_type', "Messenger")->where('branch',$branch)->where('area',$area)->where('userid', $id)->first();
        $msg = Messenger::all();
        $senderNames = User::where('user_type',"User")->get();

        $transactions = Transaction::where('assign', $msgAssign->assignedArea)->where('area', $area)->where('branch', $branch)->get();
       
        return view('pages.allMessenger')->with('messenger', $messenger)->with('msg', $msg)->with('transactions', $transactions)->with('senderNames', $senderNames)->with('msgName', $msgName)->with('msgAssign', $msgAssign);
    } 
    public function home()
    {
        return view('pages.messenger');
    }
    public function editMessenger($id)
    {
        $messenger = Messenger::find($id);

       return view('pages.edit_messenger')->with('results', $messenger);
    }
    public function profile()
    {
        $id1 = Auth::user()->userid;
        $messenger = Messenger::find($id1);
        return view('pages.messengerProfile')->with('messenger',$messenger);
    }
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->area = $request->input('area');
        $user->branch = $request->input('branch');

        $id1 = Auth::user()->userid;
        $messenger = Messenger::find($id1);
        $messenger->plateNo = $request->input('plateNo');
        $messenger->address = $request->input('address');
        $messenger->contact = $request->input('contact_num');
        $messenger->assignedArea = $request->input('assignedArea');

        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file->move('images', $file->getClientOriginalName());
        $messenger->picture = $file->getClientOriginalName();
      }
        $user->save();
        $messenger->save();
        return redirect('/messengerProfile');
    }

    protected function messengerView()
    {

        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $assigned = AssignedArea::where('branch', $branch)->where('area', $area)->get();
        return view('pages.addMessenger')->with('assigned', $assigned);
    }

    public function add(MessengerValidation $request)
    {
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $messenger = new Messenger();
        $messenger->plateNo = $request->input('plateNo');
        $messenger->address = $request->input('address');
        $messenger->contact = $request->input('contact_num');
        $messenger->assignedArea = $request->input('assignedArea');
        $user = new User();
        $user->fname =  $request->input('fname');
        $user->lname =  $request->input('lname');
        $user->email =  $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->user_type = "Messenger";
        $user->area = $area;
        $user->branch = $branch;
        $messenger->save();
        $id = $messenger->id;
        $id1 = Messenger::find($id);
        $user->userid = $id1->id;
        $user->save();
        return redirect('/allMessenger');

    }

    public function p2pView()
    {
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $messenger_id = Auth::user()->userid;
        $messenger = Messenger::find($messenger_id);
        $transactions = Transaction::where('branch',$branch)->where('area',$area)->where('assign',$messenger->assignedArea)->get();
        $senderName = User::where('user_type', 'User')->get();
        return view('pages.messenger_p2p')->with('transactions',$transactions)->with('senderName', $senderName)->with('messenger_id',$messenger_id);
    }

    public function trackStore()
    {
        $messenger_id = Auth::user()->userid;
        $transactions = Transaction::all();
        $senderName = User::where('user_type', 'User')->get();
        if(Input::get('latitude') != '' && Input::get('longitude') != '')
        {
            $track = new Track();
            $track->messenger_id = Input::get('id');
            $track->latitude = Input::get('latitude');
            $track->longitude = Input::get('longitude');
            $track->save();
        }
       
        return redirect('messengerP2P')->with('transactions',$transactions)->with('senderName', $senderName)->with('messenger_id',$messenger_id);
    }

    public function erase($id){
        $user = User::where('userid', '=', $id)->firstOrFail();
        $msg = Messenger::find($id);
        $user->delete();
        $msg->delete();
        return redirect::to('adminHome');
    }
    public function assign($id){
        $msg = Messenger::where('id', '=',$id)->firstOrFail();
        $msg->assignedArea = Input::get('assign');
        $msg->save();
        return redirect::to('adminHome');
    }

    public function addArea()
    {
        $sender_id = Auth::user()->userid;
        $branches = Branch::all();
        $adminBranch = Auth::user()->branch;
        $adminArea = Auth::user()->area;
        $locations = Branch::where('branch', $adminBranch)->where('area', $adminArea)->get();
        $locations2 = Branch::where('branch', $adminBranch)->where('area', $adminArea)->first();

        return view('pages.addArea')->with('sender_id',$sender_id)->with('branches', $branches)->with('locations', $locations)->with('locations2', $locations2);
    }
    public function addArea1(Request $data)
    {
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $assArea = new AssignedArea();
        $assArea->branch = $branch;
        $assArea->area = $area;
        $assArea->assigned = $data->input('areaName');
        $assArea->latitude = $data->input('latitude');
        $assArea->longitude = $data->input('longitude');;
        $assArea->save();
        return Redirect::to('/addArea');
}
public function addArea2()
    {
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $assigned = AssignedArea::where('branch', $branch)->where('area', $area)->get();

        return view('pages.view_areas')->with('assigned', $assigned);
    }
    public function addArea3($id)
    {
        $sender_id = Auth::user()->userid;
        $branches = Branch::all();
        $adminBranch = Auth::user()->branch;
        $adminArea = Auth::user()->area;
        $locations = Branch::where('branch', $adminBranch)->where('area', $adminArea)->get();
        $locations2 = Branch::where('branch', $adminBranch)->where('area', $adminArea)->first();
        $receiver = AssignedArea::find($id);

        return view('pages.updateArea')->with('receiver', $receiver)->with('sender_id',$sender_id)->with('branches', $branches)->with('locations', $locations)->with('locations2', $locations2);
    }
    public function updateArea(Request $data, $id)
    {
        $areaName = AssignedArea::find($id);
        $areaName->assigned = $data['areaName'];
        $areaName->latitude = $data['latitude'];
        $areaName->longitude = $data['longitude'];
        $areaName->save();
        $sender_id = Auth::user()->userid;
        $branches = Branch::all();
        $adminBranch = Auth::user()->branch;
        $adminArea = Auth::user()->area;
        $locations = Branch::where('branch', $adminBranch)->where('area', $adminArea)->get();
        $locations2 = Branch::where('branch', $adminBranch)->where('area', $adminArea)->first();
        $receiver = AssignedArea::find($id);

        return view('pages.updateArea')->with('receiver', $receiver)->with('sender_id',$sender_id)->with('branches', $branches)->with('locations', $locations)->with('locations2', $locations2);
    }
    public function deleteArea($id)
    {
        $receiver = AssignedArea::find($id);
        $receiver->delete();
        return Redirect::to('/viewArea');
    }
}


