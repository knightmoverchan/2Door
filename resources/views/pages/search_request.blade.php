@extends('layouts.headerMaster')

@section('title')
 2Door 
@stop

@section('header')
 
  <li class="active"><a href="cashierhome#"> Requests </a></li>
  <li><a href="receipt">Transactions</a></li>
  <li><a href="auth/logout">Log out</a></li>
@stop

@section('head')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBQkmmSeG_XteRRMhuYBPaGk6mM3sKX6s&libraries=places"></script>
  <style type="text/css">
.pagination li {
  display:inline-block;
  padding:5px;
}
  </style>

@stop

@section('content')
  <br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default"> 
        <br><br><br/><h2>Delivery Requests</h2>
<br><br>

      <div id="users">
              <input type="text" class="search" placeholder="Search" />
                <a style="position:absolute; right:220px;" href="/allrequest"> View All Requests</a>         
          <form role="form" method="POST" action="/search ">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <br/>           
             
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Transaction No.</th>
                  <th>Sender's Name</th>
                  <th>Receiver's Name</th>
                  <th>Receiver's Contact</th> 
                  <th>Package Type</th>
                  <th>Date Requested</th>
                  <th></th>
                  </tr>
              </thead>

              <tbody class="list">
              @foreach($result as $res)
              
               <input type="hidden" name="send" value="{{ $res->sender_id }}"> 
           

                <tr>
                  <td class="id"> {{ $res->id }} </td>
                  @foreach($senders as $sender)
                  @if($res->sender_id == $sender->userid && $sender->user_type == 'User')
                  <td class="sender"> {{ $sender->lname }},
                       {{ $sender->fname }}</td>

                  @endif
                  @endforeach
                  <td class="name"> {{ $res->receiverLname }},
                       {{ $res->receiverFname }}</td>
                  <td class="contact"> {{ $res->receiverContact }} </td>
                  <td class="type"> {{ $res->packType }} </td>
                  <td class="date"> {{ $res->updated_at }} </td>
                  <td><center><button class="btn" name="requestID" value="{{ $res->id }}"> View Transaction </button></center></td>
                  
                </tr>
            
              @endforeach
              </tbody>
            </table>
            <center><ul class="pagination"></ul></center>
           
            </div>
    </form>
            
        </div>               
      </div>   
    </div> 
  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>  
<script src="http://listjs.com/no-cdn/list.js"></script>
<script src="http://listjs.com/no-cdn/list.pagination.js"></script>
  
  <script type="text/javascript">

var monkeyList = new List('users', {
  valueNames: ['name', 'sender', 'type'],
  page: 15,
  plugins: [ ListPagination({}) ] 
});

</script>


@stop



