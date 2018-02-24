<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SweeptakeOffer;
use App\Models\UserSweeptakeOffer;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Sweepstake;
use App\Models\UserPackageDetails;
use App\Models\sweeptake_offer_user;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use DB;
use DateTime;
class SweeptakeOfferController extends Controller
{


    /**
     * @var string
     */


    /**
     * @var array
     */


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();

    }

    public function getIndex()
    {
        $today = date('Y-m-d');
        $user = $this->user;
        $sweeptakejoin = SweeptakeOffer::with(['userSweeptake' => function($q) use($user){
                    $q->where('users.id', $user->id);
                }])->where('till_at','>=',$today)
                ->get();
        // return $sweeptakejoin;
        if ($this->user->is_admin) {
            return $this->render('admin.sweeptake_join.index', compact('sweeptakejoin'));
        } else {
            return $this->render('user.sweeptakes_join.join', compact('sweeptakejoin'));
        }
    }


    public function getAdd()
    {
        return $this->render('admin.sweeptake_join.add');
    }

    public function postAdd(Request $request)
    {
        $sweeptakejoin = SweeptakeOffer::all();
        $rules = [
            'win_product' => 'required|max:255',
            'sweeptakes_entry' => 'required',
            'no_of_winner' => 'required',
            'limit_of_participate' => 'required',
            'till_at' => 'required'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {
            SweeptakeOffer::create([

                'win_product' => $request->get('win_product'),
                'sweeptakes_entry' => $request->get('sweeptakes_entry'),
                'no_of_winner' => $request->get('no_of_winner'),
                'limit_of_participate' => $request->get('limit_of_participate'),
                'till_at' => $request->get('till_at'),
            ]);
            Flash::success(' created successfully.');
            return redirect('sweeptakesjoin');

        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }

    public function getEdit(Request $request)
    {
        $sweeptakejoin = SweeptakeOffer::find($request->get('id'));
        if (!$sweeptakejoin) {
            Flash::error('not found');
            return redirect()->back();
        }
        return $this->render('admin.sweeptake_join.edit', compact('sweeptakejoin'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $sweeptakejoin = SweeptakeOffer::find($request->get('id'));
        if (!$sweeptakejoin) {
            Flash::error(' not found');
            return redirect()->back();
        }

        $rules = [

            'win_product' => 'required|max:255',
            'sweeptakes_entry' => 'required',
            'no_of_winner' => 'required',
            'limit_of_participate' => 'required',
            'till_at' => 'required'

        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {

            $sweeptakejoin->win_product = $request->get('win_product');
            $sweeptakejoin->sweeptakes_entry = $request->get('sweeptakes_entry');
            $sweeptakejoin->no_of_winner = $request->get('no_of_winner');
            $sweeptakejoin->limit_of_participate = $request->get('limit_of_participate');
            $sweeptakejoin->till_at = $request->get('till_at');

            $sweeptakejoin->save();
            Flash::info('updated successfully');
            return redirect()->back();
        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }
    public function getDelete(Request $request)
    {
        $sweeptakejoin = SweeptakeOffer::find($request->get('id'));
        if ($sweeptakejoin) {
            $sweeptakejoin->delete();
            Flash::success('deleted successfully');
            return 'ok';
        } else {
            return 'no';
        }
    }
    public function getSweeptakeOfferByID($id){
        $response=SweeptakeOffer::find($id);
        return $response;
    }
    public function getSweeptakeUserBy($id){
        $referCandidate=new \App\Models\UserSweeptakeOffer();
        $response=getSweeptakeUserBy($id);
        return $response;
    }

    public function joinUser(Request $request)
    {
        $temp1 = $request->get('sweeptake_offers_id');
        $temp2 = $request->get('users_id');
        $userRecord = UserSweeptakeOffer::where('sweeptake_offers_id', '=', $temp1)->where('users_id', '=', $temp2)->get();
        $point = $request->get('sweeptake_point');
        $pointdata = UserPackageDetails::where('users_id', $temp2)->where('sweeptake_point', '>', $point)->get();

            if ($pointdata->isEmpty()) {
                 Flash::error('You dont have sufficient Point to Join this so Purchase the Sweeptake....');
               return $this->render('user.extraSweeptake');
              //  return redirect()->back();
            } else {
                $rules = [
                    'sweeptake_offers_id' => 'required',
                    'users_id' => 'required',
                    'package_Status' => 'required'

                ];
                $validate = Validator::make($request->all(), $rules);
                if ($validate->valid()) {
                    UserSweeptakeOffer::create([
                        'sweeptake_offers_id' => $request->get('sweeptake_offers_id'),
                        'users_id' => $request->get('users_id'),
                        'package_Status' => $request->get('package_Status'),
                    ]);
                    $this->editSweeptakePoint($request);
                  Flash::success('You Are Join Successfully To This......');
                    return redirect()->back();
                }
            }
        }


    public function editSweeptakePoint($request)
    {
        $temp2 = $request->get('users_id');
        $point = $request->get('sweeptake_point');
        $user_info = DB::table('sweeptake_balance')
            ->select('sweeptake_point')
            ->where('users_id',$temp2)
            ->get();
        $balance = $user_info->first()->sweeptake_point;
        $remaningPoint=$balance-$point;
        $data = UserPackageDetails::where('users_id', $temp2)->get();
        $id=$data->first()->id;

      DB::update('update sweeptake_balance set sweeptake_point =? where id =?',[$remaningPoint,$id]);
//        return $this->render('user.sweeptakes_join.join');
    }


    public function getWinner(Request $request)
    {     $sweeptakedata = UserSweeptakeOffer::all();
        $sweeptakedata1 = DB::table('user_sweeptake_offers')
                         ->select('sweeptake_offers_id')
                            ->get();
        $user_info = DB::table('user_sweeptake_offers')
            ->select('sweeptake_offers_id', DB::raw('count(*) as total'))
            ->groupBy('sweeptake_offers_id')
            ->get();
        return $user_info;
        }

}