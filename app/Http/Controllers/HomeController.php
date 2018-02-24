<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Subscription;
use App\Models\Sweepstake;
use App\Models\PurchaseCoin;
use App\Models\SweeptakeOffer;
use App\MOdels\ExtraSweeptake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $subscriptions = Subscription::all()->count();
        $userdata = User::where('is_admin', 0)->get()->count();
        $sweeptakes = Sweepstake::all()->count();
        $purchase = PurchaseCoin::all()->count();
        $extrasweeptake=ExtraSweeptake::all()->count();
        $today = date('Y-m-d');
        $sweeptakes_join = DB::table('sweeptake_offers')
            ->select('*')
            ->where('till_at','>=',$today)
            ->get()->count();
        return $this->render('home.index', compact('subscriptions', 'userdata', 'sweeptakes','extrasweeptake', 'purchase','sweeptakes_join'));

    }
    public function getIndex1()
    {

        return $this->render('home.landing');

    }
}

