<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Config;
use App\Models\User;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Agreement;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Payer;




class PlanController extends Controller
{
    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('is_admin');
        // Detect if we are running in live mode or sandbox
        /*  if(config('paypal.settings.mode') == 'live'){
              $this->client_id = config('paypal.live_client_id');
              $this->secret = config('paypal.live_secret');
          } else {
              $this->client_id = config('paypal.sandbox_client_id');
              $this->secret = config('paypal.sandbox_secret');
          }*/

        // Set the Paypal API Context/Credentials

        $paypal_conf = Config::get('paypal');

        //dd($paypal_conf);
        $this->apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->apiContext->setConfig($paypal_conf['settings']);
    }
    public function create_plan(){

        // Create a new billing plan

        $plan = new Plan();
        $plan->setName('App Name Monthly Billing')
            ->setDescription('Monthly Subscription to the App Name')
            ->setType('infinite');
      //  return $plan;
        //dd($plan);
        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval('2')
            ->setCycles('12')
            ->setAmount(new Currency(array('value' => 9, 'currency' => 'USD')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
       $merchantPreferences->setReturnUrl('http://127.0.0.1:8000/payment/success')
            ->setCancelUrl('http://127.0.0.1:8000/cancel')
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('0');

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);
//create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);
           // dd($plan->create($this->apiContext));
            try {
                $patch = new Patch();
                $value = new PayPalModel('{"state":"ACTIVE"}');
                $patch->setOp('replace')
                    ->setPath('/')
                    ->setValue($value);
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);
                $createdPlan->update($patchRequest, $this->apiContext);
                $plan = Plan::get($createdPlan->getId(), $this->apiContext);

                // Output plan id
                echo 'Plan ID:' . $plan->getId();
                dd($plan->getId());
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {

                die($ex);
            }
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

    }


    }