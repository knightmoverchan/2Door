<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Borla\Chikka\Chikka;
use Input;
use App\User;
use App\Report;
use App\Transaction;
use Auth;
use App\Messenger;

class SMSController extends Controller
{
  protected function create()
  {
    $textType = Input::get('textType');
    $messenger_id = Auth::user()->userid;
    $branch = Auth::user()->branch;
    $area = Auth::user()->area;
    $messenger = Messenger::find($messenger_id);
    $transactions = Transaction::where('branch',$branch)->where('area',$area)->where('status',"Main to Designated Branch")->orWhere('status',"Source to Main Branch")->where('assign',$messenger->assignedArea)->get();
    $senderName = User::where('user_type',"User")->get();
        
      foreach($transactions as $transaction)
      { 
        foreach ($senderName as $sname) 
        {
          if($transaction->senderid == $sname->userid && $messenger->assignedArea == $transaction->assign)
          {
            $messageSender = 'your package is currently at '.$transaction->branchName.' Branch and is ready to dispatch to your receiver '.$transaction->receiverFname.' '.$transaction->receiverLname.'.  - JRS Express(Powered by 2door)';
            $messageReceiver = 'your package is currently at '.$transaction->branchName.' Branch and is ready to dispatch to you.  - JRS Express(Powered by 2door)';
            $status = $transaction->branchName." Sub-Branch to Receiver";
             
            $this->textSMS($transaction->id, $messageSender, $messageReceiver);   
            if($transaction->status != "Delivered")
            {
              $transaction = Transaction::find($transaction->id);
              $transaction->status = "Branch To Receiver";
              $transaction->save();

              $report = new Report();
              $report->transaction_id = $transaction->id;
              $report->description = $status;
              $report->save(); 
            } 
          }

        }   
      }
    return redirect('/messengerP2P')->with('sender',$senderName);
  }

  protected function textSMS($id, $msgSender, $msgReceiver)
  {
      $code = [
        'shortcode'=> '292900986',
        'client_id'=> '8beb5bf90229deb6e9a00b636aed2438992603b069333ab8a2c569cb38df0d28',
        'secret_key'=> 'dca8a9e1285d3af29779f5e72595b0b96a3e4267c70081c125f13e6df6dce6f8',
      ];        
          $transaction = Transaction::find($id);
          $senderName = User::where('user_type',"User")->where('userid',$transaction->senderid)->get();
          foreach($senderName as $sName)
          {
              $messageSender = 'Hello '.$sName->fname.' '.$sName->lname.', '.$msgSender;
          }
          $messageReceiver = 'Hello '.$transaction->receiverFname.' '.$transaction->receiverLname.', '.$msgReceiver;
          $out = new Chikka($code);
          $output = $out->send($transaction->sendercontact, $messageSender);
          $output = $out->send($transaction->receivercontact, $messageReceiver);
         
  }
  
  protected function successDelivery($id)
  { 
      $code = 
      [
        'shortcode'=> '292900986',
        'client_id'=> '8beb5bf90229deb6e9a00b636aed2438992603b069333ab8a2c569cb38df0d28',
        'secret_key'=> 'dca8a9e1285d3af29779f5e72595b0b96a3e4267c70081c125f13e6df6dce6f8',
      ];        
          $transaction = Transaction::find($id);
          $senderName = User::where('user_type',"User")->where('userid',$transaction->senderid)->first();
          $message = 'Hello '.$senderName->fname.' '.$senderName->lname.', your parcel has been delivered and received by '.$transaction->receiverFname.' '.$transaction->receiverLname.'. Thank you for trusting our service. - 2Door';
          $out = new Chikka($code);
          $output = $out->send($transaction->sendercontact, $message);
          
          $transaction->status = "Delivered";
          $transaction->save();
          $report = new Report();
          $report->transaction_id = $id;
          $report->description = "Successfully Delivered!";
          $report->save();

        return redirect('/messengerP2P');
    }

    public function submitToMain()
    {    
      $id[] = Input::get('transactions');
      $branchType = Input::get('branchType');
      $type = Input::get('type');
      $adminArea = Auth::user()->area; 

      $length = count($id[0]);
      
      $report = new Report();

      for($i=0; $i < $length; $i++)
      {
        $transaction = Transaction::find($id[0][$i]);
        if($branchType == "Sub-Branch")
        {
          if($type = "Outgoing")
          {   
            $transaction->status = "Source to Main Branch";
            $transaction->save();
            
            $report = new Report();
            $report->transaction_id = $id[0][$i];
            $report->description = "Dispatch to ". $transaction->areaOrigin." Main Branch";
            $report->save();
            
            $messageSender = 'your package is now ready to dispatch to '.$transaction->areaOrigin.' Main Branch.  - JRS Express(Powered by 2door)';
            $messageReceiver = 'your package is now ready to dispatch to '.$transaction->areaOrigin.' Main Branch.  - JRS Express(Powered by 2door)';
          }
          else
          {
            $transaction->status = "Main to Designated Branch";
            $transaction->save();

            $report = new Report();
            $report->transaction_id = $id[0][$i];
            $report->description = "Dispatched from ".$transaction->branchName." Sub-Branch to Receiver";
            $report->save();

            $messageSender = 'Hello '.$sname->fname.' '.$sname->lname.', your package is ready to be dispatch to your receiver '.$transaction->receiverFname.' '.$transaction->receiverLname.'.  - JRS Express(Powered by 2door)';
            $messageReceiver = 'Hello '.$transaction->receiverFname.' '.$transaction->receiverLname.', your package is ready to be dispatch to you.  - JRS Express(Powered by 2door)';               
          }
          $this->textSMS($id[0][$i], $messageSender, $messageReceiver); 

        }
        else if($branchType == "Main")
        { 
          if($transaction->area != $adminArea)
          {
              $transaction->status = "Main Branch to Port";
              $transaction->save();

              $report = new Report();
              $report->transaction_id = $id[0][$i];
              $report->description = "Main to ". $transaction->areaOrigin." Port";
              $report->save();
                      
              $messageSender = 'your package is currently in '.$transaction->areaOrigin.' Main Branch and now ready to dispatch to '.$transaction->areaOrigin.' port.  - JRS Express(Powered by 2door)';
              $messageReceiver = 'your package is currently in '.$transaction->areaOrigin.' Main Branch and now ready to dispatch to '.$transaction->areaOrigin.' port.  - JRS Express(Powered by 2door)';
          }
          else
          {
              $transaction->status = "Main to Designated Branch";
              $transaction->save();
              $report = new Report();
              $report->transaction_id = $id[0][$i];
              $report->description = "Main to ". $transaction->branchName." Sub-Branch";
              $report->save();
                      
              $messageSender =  'your package is currently in '.$transaction->area.' Main Branch and will be dispatched to '. $transaction->branchName.' Sub-branch that is near to your receiver '.$transaction->receiverFname.' '.$transaction->receiverLname.'. - JRS Express(Powered by 2door)';
              $messageReceiver = 'your package is currently in '.$transaction->area.' Main Branch and will be dispatched to '. $transaction->branchName.' Sub-branch that is near to you.  - JRS Express(Powered by 2door)';
          }
          
              $this->textSMS($id[0][$i], $messageSender, $messageReceiver); 

        }

      }
      return redirect('/adminHome');
    }
  }