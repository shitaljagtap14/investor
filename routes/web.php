<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.landing');
});

Route::get('/home', function () {
    return redirect(url( Auth::check() ? "home" : "login"));
});
Route::get('subcription/status', 'ApiController@viewSubcriptionByStatus');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('verify', 'Auth\RegisterController@verify');
Route::get('welcome', 'Auth\SignupController@getWelcome');

Route::get('home','HomeController@getIndex');
Route::get('investor','HomeController@getIndex1');


Route::get('subscription','SubscriptionsController@getIndex');
Route::get('subscription/add','SubscriptionsController@getAdd');
Route::post('subscription/add','SubscriptionsController@postAdd');
Route::get('subscription/edit','SubscriptionsController@getEdit');
Route::post('subscription/edit','SubscriptionsController@postEdit');
Route::get('subscription/del','SubscriptionsController@getDelete');


Route::get('sweepstakes','SweepstakesController@getIndex');
Route::get('sweepstakes/add','SweepstakesController@getAdd');
Route::post('sweepstakes/add','SweepstakesController@postAdd');
Route::get('sweepstakes/edit','SweepstakesController@getEdit');
Route::post('sweepstakes/edit','SweepstakesController@postEdit');
Route::get('sweepstakes/del','SweepstakesController@getDelete');


Route::get('purchase','PurchaseCoinController@getIndex');
Route::get('purchase/add','PurchaseCoinController@getAdd');
Route::post('purchase/add','PurchaseCoinController@postAdd');
Route::get('purchase/edit','PurchaseCoinController@getEdit');
Route::post('purchase/edit','PurchaseCoinController@postEdit');
Route::get('purchase/del','PurchaseCoinController@getDelete');


Route::get('user','NewUserController@getIndex');
Route::get('user/add','NewUserController@getAdd');
Route::post('user/add','NewUserController@postAdd');
Route::get('user/edit','NewUserController@getEdit');
Route::post('user/edit','NewUserController@postEdit');
Route::get('user/del','NewUserController@getDelete');


Route::get('role','RoleController@getIndex');
Route::get('role/add','RoleController@getAdd');
Route::post('role/add','RoleController@postAdd');
Route::get('role/edit','RoleController@getEdit');
Route::post('role/edit','RoleController@postEdit');
Route::get('role/del','RoleController@getDelete');

Route::get('sweeptakesjoin','SweeptakeOfferController@getIndex');
Route::get('sweeptakesjoin/add','SweeptakeOfferController@getAdd');
Route::post('sweeptakesjoin/add','SweeptakeOfferController@postAdd');
Route::get('sweeptakesjoin/edit','SweeptakeOfferController@getEdit');
Route::post('sweeptakesjoin/edit','SweeptakeOfferController@postEdit');
Route::get('sweeptakesjoin/del','SweeptakeOfferController@getDelete');
Route::get('sweeptakesjoin/winner','SweeptakeOfferController@getWinner');
//only for extra sweeptake point without subcrition
Route::get('extrasweeptake','ExtraSweeptakeController@getIndex');
Route::get('extrasweeptake/add','ExtraSweeptakeController@getAdd');
Route::post('extrasweeptake/add','ExtraSweeptakeController@postAdd');
Route::get('extrasweeptake/edit','ExtraSweeptakeController@getEdit');
Route::post('extrasweeptake/edit','ExtraSweeptakeController@postEdit');
Route::get('extrasweeptake/del','ExtraSweeptakeController@getDelete');


//user panel
Route::get('subscriptionuser','SubscriptionsController@getIndex');
Route::get('sweeptakesuser','SweepstakesController@getIndex');
Route::get('purchaseuser','PurchaseCoinController@getIndex');
Route::get('join/sweeptakes','SweeptakeOfferController@getIndex');
Route::post('join/sweeptakes/user','SweeptakeOfferController@joinUser');
Route::get('extrasweeptakeuser', 'ExtraSweeptakeController@getIndex');
/* user profile*/
Route::get('user/edit','ProfileController@getEdit');
Route::post('user/edit','ProfileController@postEdit');

/* Winner */
Route::get('participate/sweeptake/user','WinnerController@showJoinSweeptake');
//Route::post('join/user/data','WinnerController@joinUserData');
Route::get('join/user/data/{id}','WinnerController@joinUserData');
Route::get('winner/list','WinnerController@showWinnerList');
Route::get('winner/user/list','WinnerController@showWinnerList');
Route::get('winner/users-list/{sweeptake}/{id}','WinnerController@showWinnerUsersList');
/* History */
Route::get('package/history','HistoryController@getIndex');
/* Balance */
Route::get('sweeptakes/balance','BalanceController@getAdd');
Route::post('sweeptakes/balance','BalanceController@postAdd');
Route::get('package/balance','BalanceController@getIndex');
Route::get('subscription/user/balance','BalanceController@showSubcription');
Route::get('sweeptakes/user/balance','BalanceController@showSweeptake');
Route::get('package/user/balance','BalanceController@showPurchase');
/* Transactions */
//Route::get('package/transaction','TransactionController@getIndex');

Route::post('package/transaction','PaypalController@transactionAdd');
/*paypal*/
Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::post('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal-status', array('as' => 'payment.status','uses' => 'PaypalController@getPaymentStatus',));

Route::get('paypal-cancel', array('as' => 'payment.cancel','uses' => 'PaypalController@cancelPaypal',));

Route::get('cancel','PaymentController@cancelPaypal');
Route::get('payment/success','PaymentController@successPaypal');
Route::get('buy','SweepstakesController@buyData');

//paypal plane
Route::get('create_paypal_plan', 'PlanController@create_plan');
/*check here for today*/
Route::get('payment-status',array('as'=>'payment.status','uses'=>'PaymentController@paymentInfo'));
Route::get('payment',array('as'=>'payment','uses'=>'PaymentController@payment'));




/*Braintree */
/*Route::get('plans', 'PlanController@index');
Route::get('plan/{plan}', 'PlanController@show');
Route::get('/braintree/token', 'BraintreeTokenController@token');
Route::post('/subscribe', 'SubscriptionsesController@store');*/




Route::get('viewSweeptake/join', 'SweeptakeOfferController@viewSweeptakeJoin');
Route::get('user/{id}','NewUserController@getUserByID');
Route::get('sweeptake/join/{id}','SweeptakeOfferController@getSweeptakeOfferByID');
Route::get('sweeptake/join/user/{id}','SweeptakeOfferController@getSweeptakeuserID');