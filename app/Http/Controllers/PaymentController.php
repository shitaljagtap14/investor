<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Subscription;
use App\Models\Product;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\Forms\SweepstakeForm;
use Kris\LaravelFormBuilder\FormBuilder;

class PaymentController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('is_admin');
        }

    public function successPaypal(Request $request)
    {
        $data = '';
        foreach ($_REQUEST as $key=>$value){
            $data .= $key."=".$value."-----";
        }

        $fp = fopen("myText.txt","wb");
        fwrite($fp,$data);
        fclose($fp);
        echo $data.'123';die;
        mail('
        ', 'paypal notification', $data);

        echo $data.'123';die;

     if($request->tx){
            if($payment=Payments::where('transaction_id',$request->tx)->first()){
                $payment_id=$payment->id;
            }else{
                $payment=new Payments;
                $payment->item_number=$request->item_number;
                $payment->transaction_id=$request->tx;
                $payment->currency_code=$request->cc;
                $payment->payment_status=$request->st;
                $payment->save();
                $payment_id=$payment->id;
            }
            return 'Pyament has been done and your payment id is : '.$payment_id;

        }else{
            return 'Payment Successful...';
            return redirect('home');
        }

    }

    public function cancelPaypal()
    {
        return $this->render('user.cancelPayment');

    }
}
