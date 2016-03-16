@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
    <li class="active"><a href="/adminHome">Home</a></li>
    <li><a href="/allMessenger">Messenger</a></li>
    <li><a href="/allCashier">Cashier</a></li>
    <li><a href="/rates">Delivery Rates</a></li>
    <li><a href="auth/logout">Log out</a></li>
    <link href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="/gotya/js/tabcontent.js" type="text/javascript"></script>
    <script src="/gotya/js/moment.min.js" type="text/javascript"></script>
    <script src="/gotya/template1/tabcontent.css" type="text/javascript"></script>
@stop    

@section('content')
    <br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h2>Delivery Transactions</h2>
          <br/><div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div style="position:absolute;top:100px;left: 80px; width: 500px; margin: 0 auto; padding: 120px 0 40px;">
                            {!! Form::open(array('url'=>'/showDate'))!!}

                                <input type="date" id="thedate" name = "date" class="search" >
                                <button class="btn btn-success"type="submit">View List</button>

                            {!! Form::close()!!}
                            <ul class="tabs" data-persist="true">
                              
                                
                                <br/>
                                <strong><a href="#view1">OUTGOING</a>/ 
                                    <a href="#view2">INCOMING</a>
                                </strong><br/>
                            </ul>
                                <br/>
                            
                              <div class="tabcontents">
                          
                                <div id="view1">
                            <!-- /.panel-heading -->
                                    <div class="panel-body">
                                    <div id="users">

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sender's Name</th>
                                                        <th>Receiver's Name</th>
                                                        <th>Destination Branch</th>
                                                        <th>Package Type</th>
                                                        <th>Date</th>
                                                        <th>View Transaction</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list"> 
                                                    @foreach($transOut as $transaction)
                                                        @foreach($senderNames as $senderName)

                                                          @if($senderName->userid == $transaction->senderid)

                                                            <tr>
                                                                <td>{{$transaction->id }}</td>
                                                                <td class="sender">{{$senderName->fname." ".$senderName->lname }}</td>
                                                                <td class="name">{{$transaction->receiverFname." ".$transaction->receiverLname }}</td>
                                                                <td class="branch">{{$transaction->branchName }}</td>
                                                                <td class="type">{{$transaction->type }}</td>
                                                                <td class="date">{{$transaction->created_at}}</td>
                                                                <td>
                                                                  <a class="btn btn-success btn-xs" href="{{ URL::to('/viewReport'.$transaction->id.'/'.$dateChoice) }}" title="View Report">View<i class="fa fa-pencil"></i></a>
                                                                </td>
                                                            </tr>
                                                         @endif
                                                        @endforeach
                                                
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                      </div>
                                        </div>
                                    <!-- /.panel-body -->
                            <div id="view2">
                         <div class="panel-body">
                          <div id="users2">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                     <tr>
                                                        <th>#</th>
                                                        <th>Sender's Name</th>
                                                        <th>Receiver's Name</th>
                                                        <th>Destination Branch</th>
                                                        <th>Package Type</th>
                                                        <th>Date</th>
                                                        <th>View Transaction</th>
                                                    </tr>
                                                <tbody class="list"> 
                                                </thead>
                                                    @foreach($transIn as $transaction)
                                                        
                                                        @foreach($senderNames as $senderName)

                                                          @if($senderName->userid == $transaction->senderid)

                                                            <tr>
                                                                <td>{{$transaction->id }}</td>
                                                                <td class="sender">{{$senderName->fname." ".$senderName->lname }}</td>
                                                                <td class="name">{{$transaction->receiverFname." ".$transaction->receiverLname }}</td>
                                                                <td class="branch">{{$transaction->branchName }}</td>
                                                                <td class="type">{{$transaction->type }}</td>
                                                                <td class="date">{{$transaction->created_at}}</td>
                                                                <td>
                                                                 <a class="btn btn-success btn-xs" href="{{ URL::to('/viewReport'.$transaction->id.'/'.$dateChoice) }}" title="View Report">View<i class="fa fa-pencil"></i></a>
                                                                </td>
                                                            </tr>
                                                         @endif
                                                        @endforeach
                                                
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                            </div>
  
  <script type="text/javascript">

var options = {
  valueNames: [ 'sender','name', 'date','branch', 'type' ]
};
 var options2 = {
  valueNames2: [ 'sender','name', 'date','branch', 'type' ]
};

var userList = new List('users', options);
var userList = new List('users2', options);

</script>
                        @if(empty($reports))

                        @else
                        <div style="position: absolute; width: 700px;top:50px; right: -900px; border-style: solid;">
                           
                            <br>
                            @foreach($transDetail as $detail)
                                @foreach($origBranchName as $obn)
                                    @if($detail->branchOrigin == $obn->branch && $detail->areaOrigin == $obn->area)
                                        @foreach($senderNames as $sname)
                                            @if($detail->senderid == $sname->userid)                                   
                                                 &nbsp; &nbsp;Transaction No. <b>{{$detail->id}} <br/></b>
                                                 &nbsp; &nbsp;Sender Name: <b>{{$sname->fname}} {{$sname->lname}} </b><br/>
                                                 &nbsp; &nbsp;Receiver Name: <b>{{$detail->receiverFname}} {{$detail->receiverLname}} </b><br/>
                                                 &nbsp; &nbsp;Receiver's Address: <b>{{$detail->address}} </b><br/>
                                                 &nbsp; &nbsp;Branch Source: <b>{{$obn->branchName}}</b><br/>
                                                 &nbsp; &nbsp;Branch Destination: <b>{{$detail->branchName}} </b><br/>
                                                 <div style="position: absolute; top:40px; right: 100px">
                                                    Cel No# <b>{{$detail->sendercontact}}</b><br/>
                                                    Cel No# <b>{{$detail->receivercontact}}</b>
                                                 </div>
                                                &nbsp; &nbsp;Package Type: <b>{{$detail->type}} </b><br/>
                                                &nbsp; &nbsp;Package Description: <b>{{$detail->description}} </b><br/>
                                                &nbsp; &nbsp;Package Weight: <b>{{$detail->weight}} grams </b><br/>
                                                &nbsp; &nbsp;Package Cost: <b>₱{{$detail->cost}} </b><br/>
                                                <br/>

                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                            <br><b>&nbsp; &nbsp;DELIVERY LOGS<br></b>
                            <strong>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Date&Time  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Desc <br/></strong>
                            
                                @foreach($reports as $report)
                                   &nbsp; &nbsp;{{ $report->created_at}}&nbsp; &nbsp; &nbsp;
                                  &nbsp; &nbsp;{{ $report->description}}&nbsp; &nbsp; &nbsp; 
                                   <br/>
                                @endforeach    
                            
                            @foreach($transDetail as $detail)
                                @foreach($messengerBranchArea as $mba)
                                    @if($mba->area == $detail->area &&  $mba->branch == $detail->branch)
                                        @foreach($messengerAssigned as $ma)
                                            @if($ma->id == $mba->userid && $ma->assignedArea == $detail->assign)
                                               <br>&nbsp; &nbsp;Messenger Assigned:<b>  {{$mba->fname}} {{$mba->lname}}<br/>.
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach 
                        @endforeach
                    @endif
                    <div id="alert"></div>
                    </div>
                 </div>

<script>

document.getElementById('thedate').value = '{{$dateChoice}}';

</script>
@stop


