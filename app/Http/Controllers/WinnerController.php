<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Winner;
use App\Models\SweeptakeOffer;
use App\Models\UserSweeptakeOffer;
use App\Models\sweeptake_offer_user;
use Illuminate\Support\Facades\Hash;
use App\Models\Sweepstake;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use DateTime;
class WinnerController extends Controller
{
    public $tempdata;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();
    }

    /**
     * Sweepstakes List
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {

        return $this->render('admin.winner.showJoinSweeptake');
    }

    public function showJoinSweeptake()
    {
        $temp = SweeptakeOffer::all();
        return $this->render('admin.winner.showJoinSweeptake', compact('temp'));

    }
    // to show the list of winner list by sweeptake
    public function showWinnerUsersList($sweeptake, $id){
        $users = Winner::with('user')->where('sweepstake_id', $id)->get();
        $sweeptakeName = ucfirst(str_replace('_', ' ', $sweeptake));
        return $this->render('user.sweeptakes_join.winnerUsersList', compact('users', 'sweeptakeName'));
    }
    // do not change this function logic
    public function joinUserData($sweeptake_id) {
        $sweeptakeOffer = SweeptakeOffer::find($sweeptake_id);

        $sweeptakeWinners = UserSweeptakeOffer::with('users')->where('sweeptake_offers_id', $sweeptake_id)->orderByRaw('RAND()')->take($sweeptakeOffer->no_of_winner)->get();

        if(count($sweeptakeWinners) > 0){
            $i = 1;
            foreach ($sweeptakeWinners as $sweeptakeWinner){
                $winner = Winner::findOrNew(['sweepstake_id' => $sweeptakeWinner->sweeptake_offers_id]);

                if (!$winner){
                    $winner->user_id = $sweeptakeWinner->users->id;
                    $winner->sweepstake_id = $sweeptakeWinner->sweeptake_offers_id;
                    $winner->winner_no = $i;

                    $winner->save();
                    $i++;
                }else{
                    die('winner is already annaunced.');
                }
            }
        }
        return $this->render('user.sweeptakes_join.winnerUserList', compact('tags'));
        //        $arrUsersIds = [];
        //        if (count($sweeptakeOfferData->userSweeptake) > 0){
        //            $users = $sweeptakeOfferData->userSweeptake->map(function ($user) {
        //                return $user->id;
        //            });
        //            dd($users);
        //            $rand_users = array_rand((array)$sweeptakeOfferData->userSweeptake);
        //        }else{
        //            die('no users.');
        //        }
        //
        //        dd($sweeptakeOfferData->userSweeptake);
        //       $sweeptakedata1 = DB::table('user_sweeptake_offers')
        //           ->select('users_id')
        //           ->where('sweeptake_offers_id',$tempvar)
        //           ->get();
        ////print_r($sweeptakedata1);
        //
        ////print_r($sweeptakedata1->isEmpty());
        //     if(!$sweeptakedata1->isEmpty()) {
        //         for ($i = 0; $i < $p; $i++) {
        //             $tempStore[] = $sweeptakedata1[$i]->users_id;
        //            dd($tempStore);
        //             print_r($tempStore);
        //         }
        //
        //
        //     }
        //     else
        //     {
        //         return"no one is join";
        //         die();
        //     }
        //    $winncount = DB::table('sweeptake_offers')
        //       ->select('no_of_winner')
        //       ->where('id',$tempvar)
        //       ->get();
        //   $balance = $winncount->first()->no_of_winner;
        //       if($p<$balance)
        //       {
        //           $balanse1=$p;
        //       }
        //       else{
        //           $balanse1=$balance;
        //       }
        //   $a =$tempStore;
        //   $b =$var1;
        //   $result = array_combine($a, $b);
        //   $winnerArray=array_rand($result,$balanse1);
        //   if(sizeof($winnerArray)==1)
        //   {
        //       $tags[]=User::find($winnerArray);
        //   }
        //   else
        //   {
        //   $tags = null;
        //   foreach($winnerArray as $value) {
        //       $tags[] = User::find($value);
        //   }
        //   }

       }

   public function showWinnerList() {
       $userSweeptakeOffers = UserSweeptakeOffer::with('sweeptakeOffers.winners')
                                ->where('users_id', $this->user->id)
                                ->get();
        return $this->render('user.sweeptakes_join.winnerList', compact('userSweeptakeOffers'));
    }
}

















