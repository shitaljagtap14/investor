<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use App\Models\Balance;
use Illuminate\Support\Facades\Validator;
use DB;
class BalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();
    }

    public function getIndex()
    {  return $this->render('user.balance.checkbalance');
    }

    public function getAdd()
    {
        return $this->render('user.userSweeptakes');
    }

    public function postAdd(Request $request)
    {
        $u_id=$request->get('users_id');
        $s_id=$request->get('sweepstakes_id');
        $s_point=$request->get('sweeptake_point');
        $data = Balance::where('sweepstakes_id', '=', $s_id)
                             ->where('users_id', '=', $u_id)
                             ->get();

       if(!$data->isEmpty())
       {
           Flash::error('You Are All ready Apply.....');
           return redirect()->back();
       }else{
           $data1= Balance::where('users_id', '=', $u_id)->get();

           if($data1->isEmpty())
           {
               $rules = [
                   'sweepstakes_id' => 'required',
                   'users_id' => 'required',
                   'sweeptake_point' => 'required'
               ];
               $validate = Validator::make($request->all(), $rules);
               if ($validate->valid()) {
                   Balance::create([

                       'sweepstakes_id' => $request->get('sweepstakes_id'),
                       'users_id' => $request->get('users_id'),
                       'sweeptake_point' => $request->get('sweeptake_point'),
                   ]);
                   Flash::success('User Join successfully.');
                   return redirect()->back();

               } else {
                   Flash::error('Please remove the errors and submit again.');
                   return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
               }
           }
           else{

               $balance = $data1->first()->sweeptake_point;
               $remaningPoint=$balance+$s_point;
               $data = Balance::where('users_id', $u_id)->get();
               $id=$data->first()->id;

               DB::update('update sweeptake_balance set sweeptake_point =? where id =?',[$remaningPoint,$id]);
               Flash::success('User Join successfully.');
               return redirect()->back();
           }

       }

    }
    public function showSweeptake()
    {
        $u_data= $this->user->id;

        $sweeptake_balance= Balance::where('users_id', '=', $u_data)->get();

       // return $sweeptake_balance;
        return $this->render('user.balance.sweeptakes_balance', compact('sweeptake_balance'));

    }
}
