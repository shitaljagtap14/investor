<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transactions;
use Validator;
use URL;
use Session;
use Redirect;
use Config;
/** All Paypal Details class **/

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\Input;
use PayPal;
use Laracasts\Flash\Flash;

class PaypalController extends Controller
{
    private $_api_context;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
        $this->middleware('auth');
        $this->middleware('is_admin');
        $paypal_conf = Config::get('paypal');
       // return $paypal_conf;
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {

          return $this->render('paywithpaypal');


    }

    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public $temp;
    public function postPaymentWithpaypal(Request $request)
    {

       $this->temp=$request;
      // dd($this->temp);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $price = $request->get('amount'); // 10 € for example

        if($price == 0) { // ensure a price above 0
            return Redirect::to('/');
            die('price empty');
        }

        // Set Item
        $item_1 = new Item();
        $item_1->setName($request->get('item_name'))
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($price); // price of all items together

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Test payment');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('paypal-status'))
            ->setCancelUrl(URL::to('paypal-cancel'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (config('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Error.');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /* here you could already add a database entry that a person started buying stuff (not finished of course) */

        if(isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        die('Error.');
    }

    public function getPaymentStatus(Request $request)
    {

        $payment_id = $request->get('paymentId');

//        Session::forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
//            \Session::put('error', 'Payment failed');
            die('Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
      //  dd($result);
       // return $result;
         // return ($result->getState());

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');
            $this->successPayment($result);


        }
        \Session::put('error', 'Payment failed');


    }

    public function successPayment($result) {
      dd($result);
      // $tempdata= $result;
        //  $this->transactionAdd($tempdata);

    }

    public function cancelPaypal()
    {
        return $this->render('user.cancelPayment');

    }
//add transaction data into transaction table
    public function transactionAdd($tempdata)
    {
       // dd($tempdata);
        $rules = [
            'users_id' => 'required|max:255',
            'payment_id' => 'required|max:255',
            'item_number' => 'required|max:255',
            'item_name' => 'required|max:255',
            'amount' => 'required|max:255',
            'date' => 'required|max:255',
        ];
        $validate = Validator::make($tempdata->all(), $rules);
        if ($validate->valid()) {
            Transactions::create([

                'users_id' => $tempdata->get('users_id'),
                'payment_id' => $tempdata->get('id'),
                'item_number' => $tempdata->get('item_number'),
                'item_name' => $tempdata->get('item_name'),
                'amount' => $tempdata->get('amount'),
                'date' => $tempdata->get('create_time'),
            ]);
            Flash::success('created successfully.');


        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }
}
