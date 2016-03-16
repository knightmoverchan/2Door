<?php

namespace App\Http\Controllers;
use DB;
use Input;
use App\Sender;
use App\Transaction;
use App\RequestDelivery;
use App\Cashier;
use App\User;
use App\Branch; 
use Request; 
use App\AssignedArea;
use App\Rate;
use App\Http\Requests\CashierRequest;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class CashierController extends Controller
{
    protected function index()
    {
        return view('pages.addCashier');
    }

    protected function listCashier()
    {   
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $cashiers = User::where('user_type', "Cashier")->where('branch',$branch)->where('area',$area)->get();
        $cashrs = Cashier::all();
       
        return view('pages.allCashier')->with('cashiers', $cashiers)->with('cashrs', $cashrs);
    }

    public function add(CashierRequest $request)
    {
        $cashier = new Cashier();
        $branch = Auth::user()->branch;
        $area = Auth::user()->area;
        $cashier->address = $request->input('address');
        $cashier->contact = $request->input('contact_num');
        $user = new User();
        $user->fname =  $request->input('fname');
        $user->lname =  $request->input('lname');
        $user->email =  $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->user_type = "Cashier";
        $user->area = $area;
        $user->branch = $branch;
        $cashier->save();
        $id = $cashier->id;
        $id1 = Cashier::find($id);
        $user->userid = $id1->id;
        $user->save();

        return redirect('/allCashier');
    }

    protected function home()
    {
      $branch = Auth::user()->branch;
      $area = Auth::user()->area;
      $senders = User::all(); 
      $result = RequestDelivery::where('originBranch',$branch)->where('originArea',$area)->where('status', '=', 'Pending')->get();
      $transactions = Transaction::all();
        return view('pages.search_request', compact('result', 'senders', 'transactions'));
    }

    protected function allrequests()
    {
      $branch = Auth::user()->branch;
      $area = Auth::user()->area;
      $senders = User::all(); 
      $transactions = Transaction::all();
      $all = RequestDelivery::where('originArea', $area)->get();
        return view('pages.allrequest', compact('result', 'senders', 'transactions', 'all'));
    }
  
    protected function search()
    {
     if (Input::has('requestID')) {
        $srch = Input::get('requestID');
        $src = Input::get('send');
        $area = Auth::user()->area;
        $result = RequestDelivery::where('id','=', $srch)->get();
        $sender = Sender::where('id', $src)->get();
        $rates = Rate::all();
        $branches = Branch::all();
        $assignedarea = AssignedArea::all();
        return view('pages.results', compact('result', 'sender', 'rates', 'branches', 'assignedarea'));
    }

    }

    protected function cost()
    {
        $weight = Input::get('weight');
        $type = Input::get('packType');

     
   $result = Rate::where('type', $type);

   foreach ($result->select('rate', 'excess', 'ecost', 'weight')->get() as $results) {
     $cost = $results->rate;
     $excess = $results->excess;
     $ecost = $results->ecost;
     $wei = $results->weight;
   }

        
            $minus = $weight-$wei;
              while ( $minus > 0) {
            
                $minus=$minus-$excess;
                $cost = $cost + $ecost;
                           
        }
    $branch = Auth::user()->branch;
      $area = Auth::user()->area;
   
    $trans =  new Transaction();
    $trans->transactionid = Request::input('id');
    $trans->type = Request::input('packType');
    $trans->weight = Request::input('weight');
    $trans->address = Request::input('receiverAddress');
    $trans->latitude = Request::input('latitude');
    $trans->longitude = Request::input('longitude');
    $trans->sendercontact = Request::input('sendercontact');
    $trans->receivercontact = Request::input('receivercontact');
    $trans->branch = Request::input('branchnumber');
    $trans->branchName = Request::input('branchName');
    $trans->area = Request::input('area');
    $trans->assign = Request::input('assignedarea');
    $trans->areaOrigin = $area;
    $trans->branchOrigin = $branch;
    $trans->receiverFname = Request::input('receiverFname');
    $trans->receiverLname = Request::input('receiverLname');
    $trans->description = Request::input('description');
    $trans->senderid = Request::input('senderid');
    $trans->cost = $cost;
    if($branch == "2")
    {
        $trans->status = "Source to Main Branch";
    }
    
    $trans->save();


    $id = Request::input('id');
    $receive = RequestDelivery::where('id', $id)->get();
    $transact = Transaction::where('transactionid', $id)->get();
      
    $req = RequestDelivery::find($id);
    $req->status = 'Validated';
    $req->save();

        return view('pages.receipt', compact('transact', 'receive'))->with('cost', $cost);
    }

protected function receipt(){
    $id = Input::get('requestID');
    $transact = Transaction::where('id', '=', $id)->get();
   
    return view('pages.receipt', compact('transact'));
   
}

protected function viewreceipt() {
    $transactions = Transaction::all();
    $senders = User::all();
    return view('pages.transactions', compact('transactions', 'senders'));
}

}
