<?php



// Authentication routes...

Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::controllers([
   'password' => 'Auth\PasswordController',
]);

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/senderHome','SenderController@getPage');
Route::get('/rates2','MessengerController@rates2');


//RECEIVER
Route::get('/requestForm', 'RequestDeliveryController@create');
Route::post('/requestForm', 'RequestDeliveryController@store');
Route::get('/receiverUpdate{id}', 'RequestDeliveryController@edit');
Route::post('/receiverUpdate{id}', 'RequestDeliveryController@update');
Route::get('/receiverDelete{id}', 'RequestDeliveryController@destroy');

//MESSENGER
Route::get('/allMessenger', 'MessengerController@listMessenger');
Route::post('/roads', 'BranchesController@roads');
Route::post('/addMessenger', 'MessengerController@add');
Route::get('/addMessenger', 'MessengerController@messengerView');
Route::get('/adminHome', 'BranchesController@index');
Route::get('/messengerHome', 'MessengerController@route');
Route::get('/messengerProfile', 'MessengerController@profile');
Route::post('/messengerUpdate', 'MessengerController@update');
Route::get('/viewAssigned{id}', 'MessengerController@showAssign');
Route::get('/viewArea','MessengerController@addArea2');
Route::get('/areaUpdate{id}', 'MessengerController@addArea3');
Route::post('/areaUpdate{id}', 'MessengerController@updateArea');
Route::get('/areaDelete{id}', 'MessengerController@deleteArea');
Route::post('/addArea', 'MessengerController@addArea1');
Route::get('/addArea', 'MessengerController@addArea');

Route::post('assignMsg/{id}', 'MessengerController@assign');
Route::get('msgDelete{id}', 'MessengerController@erase');

Route::get('/rates', 'MessengerController@rates');
Route::post('/rates/{type}', 'MessengerController@changerate');


Route::post('/messengerP2P', 'SMSController@create');
Route::get('/messengerP2P', 'MessengerController@p2pView');
Route::get('routing', 'MessengerController@route');

//CASHIER
Route::get('/allCashier', 'CashierController@listCashier');
Route::get('/allrequest', 'CashierController@allrequests');
Route::get('/addCashier', 'CashierController@index');
Route::post('/addCashier', 'CashierController@add');
Route::get('/cashierhome', 'CashierController@home');
Route::post('/search', 'CashierController@search');
Route::post('/cost', 'CashierController@cost');
Route::get('/receipt', 'CashierController@viewreceipt');
Route::post('/receipt', 'CashierController@receipt');
Route::get('/branches', 'BranchesController@index');
Route::get('/requests', 'BranchesController@index');


//SMS
Route::get('/statusDelivered{id}', 'SMSController@successDelivery');
Route::get('/receiveMsg', 'SMSController@receiveSMS');
Route::post('/track', 'MessengerController@trackStore');
Route::post('/submitTransaction', 'SMSController@submitToMain');

//Reports
Route::get('/allTransReports', 'BranchesController@listReports');
Route::post('/showDate', 'BranchesController@seeDate');
Route::get('/viewReport{id}/{date}', 'BranchesController@seeReport');
