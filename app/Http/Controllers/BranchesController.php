<?php

namespace App\Http\Controllers;
use DB;
use Input;
use App\Messenger;
use App\Track;
use App\Branch;
use App\AssignedArea;
use App\Sender;
use App\Transaction;
use App\RequestDelivery;
use App\Cashier;
use App\User;
use App\Report;
use Request; 
use App\Http\Requests\CashierRequest;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class BranchesController extends Controller
{
    public function index()
    {
        $adminBranch = Auth::user()->branch;
        $adminArea = Auth::user()->area; 
        $requests = Transaction::where('branch', $adminBranch)->where('area', $adminArea)->get();  
       
        $areas = AssignedArea::where('branch', $adminBranch)->where('area', $adminArea)->get(); 
        $locations = Branch::where('branch', $adminBranch)->where('area', $adminArea)->get();
            
            if($adminBranch == "2")
            {         
                $branchType = "Main";
                $transOut =  Transaction::where('areaOrigin',$adminArea)->where('status','Source to Main Branch')->get();
                $transIn =  Transaction::where('area',$adminArea)->where('status','Main Branch to Port')->get();
            }   
            else
            {
                $branchType = "Sub-Branch";
                $transOut =  Transaction::where('areaOrigin',$adminArea)->where('branchOrigin',$adminBranch)->where('status','Pending')->get();
                $transIn =  Transaction::where('area',$adminArea)->where('branch',$adminBranch)->where('status','Main to Designated Branch')->get();

            }

        return view('pages.admin', compact('locations', 'areas','adminArea','adminBranch','transactions','requests', 'branchType','transIn','transOut'));
    }


    
 public function roads()
    {   
        $area = Auth::user()->area;
        $branch1 = Auth::user()->branch;
        $id = Input::get('btn');
        $assarea = Input::get('assignedarea');
        $track = Track::where('messenger_id', $id)->get();
        $pictures = Messenger::where('id', $id)->get();
        $messengers = User::where('userid', $id)->where('user_type', '=', 'Messenger')->get();
        $transactions = Transaction::where('area', $area)->where('branch', $branch1)->where('assign', $assarea)->where('status', '=', 'Delivered' )->orderBy('updated_at', 'asc')->get();
        $alltransactions = Transaction::where('area', $area)->where('branch', $branch1)->where('assign', $assarea)->get();
        $address = Transaction::all();
        $user = User::where('userid', '=', $id )->get();
        $branch = Branch::all();
        $msg = Messenger::where('id', '=', $id)->get();
        $assigned = AssignedArea::all();
        $trans = Transaction::where('branch', '=', $branch1)->where('area', '=', $area)->get();
        $assignedArea = AssignedArea::where('branch', '=', $branch1)->where('area', '=', $area)->get();
        $trans1 = Transaction::where('branch', '=', $branch1)->where('area', '=', $area)->get();

      return view('pages.radius', compact('transactions', 'messengers', 'pictures', 'track', 'alltransactions','address', 'user', 'branch', 'msg', 'assigned', 'assignedArea', 'trans', 'trans1'));   
   }

    public function listReports()
    {
        $dateChoice = date("Y-m-d");

        $adminBranch = Auth::user()->branch;
        $adminArea = Auth::user()->area; 
        $senderNames = User::where('user_type',"User")->get();
        $transOut =Transaction::where(DB::raw('CAST(created_at AS DATE)'), $dateChoice)->where('areaOrigin',$adminArea)->where('branchOrigin',$adminBranch)->get();

        $transIn =Transaction::where(DB::raw('CAST(created_at AS DATE)'), $dateChoice)->where('area',$adminArea)->where('branch',$adminBranch)->get();
        $reports = "";
        $transDetail = "";
        $messengerBranchArea = "";
        return view('pages.reports', compact('transIn','transOut','senderNames','reports','transDetail','messengerBranchArea','dateChoice'));
    }
    public function seeReport($id,$date)
    {   
        $dateChoice = $date;
        $reports = Report::where('transaction_id', $id)->get();
        $adminBranch = Auth::user()->branch;
        $adminArea = Auth::user()->area; 
        $transDetail = Transaction::where('id',$id)->get();
        $origBranchName = Branch::all();
        $senderNames = User::where('user_type',"User")->get();
        $messengerAssigned = Messenger::all();
        $messengerBranchArea = User::where('user_type',"Messenger")->get();
        $transOut =Transaction::where(DB::raw('CAST(created_at AS DATE)'), $dateChoice)->where('areaOrigin',$adminArea)->where('branchOrigin',$adminBranch)->get();
        $transIn =Transaction::where(DB::raw('CAST(created_at AS DATE)'), $dateChoice)->where('area',$adminArea)->where('branch',$adminBranch)->get();
        return view('/pages.reports', compact('transIn','transOut','senderNames','reports', 'transDetail', 'origBranchName','messengerAssigned','messengerBranchArea','dateChoice'));
    }

    public function seeDate()
    {
        $dateChoice = Input::get('date');
        $adminBranch = Auth::user()->branch;
        $adminArea = Auth::user()->area; 
        $origBranchName = Branch::all();
        $senderNames = User::where('user_type',"User")->get();
        $messengerAssigned = Messenger::all();
        $messengerBranchArea = User::where('user_type',"Messenger")->get();
        $transOut =Transaction::where(DB::raw('CAST(created_at AS DATE)'), $dateChoice)->where('areaOrigin',$adminArea)->where('branchOrigin',$adminBranch)->get();
        $transIn =Transaction::where(DB::raw('CAST(created_at AS DATE)'), $dateChoice)->where('area',$adminArea)->where('branch',$adminBranch)->get();
        return view('/pages.reports', compact('transIn','transOut','senderNames','reports', 'transDetail', 'origBranchName','messengerAssigned','messengerBranchArea','dateChoice'));
    }


}
