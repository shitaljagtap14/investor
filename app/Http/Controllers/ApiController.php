<?php

namespace App\Http\Controllers;

use App\Models\PurchaseCoin;
use App\Models\Subscription;
use App\Models\Sweepstake;
use App\Models\User;
use App\Models\UserSweeptakeOffer;
use App\Models\SweeptakeOffer;
use App\Models\Winner;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Contracts\Auth\Guard;
class ApiController extends Controller
{
    /**
     * @var bool
     */
    protected $response = FALSE;

    /**
     * @var string
     */
    protected $error = '';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * apiController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->invalid()) {
            $this->error = $validate->errors();
            return response()->json(['response' => $this->response, 'error' => $this->error]);
        } else {
            $this->data = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        }
    }

    public function getLoginUser()
    {
        $this->data = $this->user;
        print($this->user);
        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $this->data = Auth::user();
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else {
            $this->error = 'Unauthorized request!';
            return response()->json(['response' => $this->response, 'error' => $this->error]);
        }
    }

    public function getUser()
    {
        $this->data = User::where('is_admin', 0)->get();
        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'User is not register';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }


    public function registerAllUser()
    {
        $this->data = User::all();

        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }

    public function getprofile($id)
    {
        $this->data = User::find($id);
        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Data is not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }

    public function editprofile(Request $request)
    {
        $this->data = User::find($request->get('id'));

        if ($this->data) {
            $this->data->name = $request->get('name');
            $this->data->first_name = $request->get('firstname');
            $this->data->last_name = $request->get('lastname');
            $this->data->email = $request->get('email');
            $this->data->password = Hash::make($request->get('new_password'));
            $this->data->save();
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else {
            $this->error = 'User authentication failed!';
            return response()->json(['response' => $this->response, 'error' => $this->error]);
        }

    }

    public function viewSubcription()
    {
        $this->data = Subscription::all();

        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Data is not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }


    public function viewSubcriptionByStatus(Request $request)
    {
        $this->data = Subscription::where('status','active')->get();
        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Data is not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }



    public function viewSweeptake()
    {
        $sweepstakes = Sweepstake::all();
        foreach ($sweepstakes as $key => $sweepstake) {
            $sweepstakes[$key]['subscription'] = $sweepstake->subscription()->get();
        }
        $this->data = $sweepstakes;
        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else {
            $this->error = 'Data is not Present';
            return response()->json(['response' => $this->response, 'error' => $this->error]);
        }
    }


    public function viewPurchase()
    {
        $this->data = PurchaseCoin::all();

        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Data is not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }

    public function viewSweeptakeOffer()
    {
        $this->data = SweeptakeOffer::all();

        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Data is not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }




public function viewSweeptakeActiveOffer()
{
    $today = date('Y-m-d');
    $this->data = SweeptakeOffer::where('till_at','>=',$today)->get();
    if (count($this->data) > 0) {
        $this->response = TRUE;
        return response()->json(['response' => $this->response, 'data' => $this->data]);
    } else
        $this->error = 'Data is not Present';
    return response()->json(['response' => $this->response, 'error' => $this->error]);
}


public function showJoinUsersList($sweeptake_id) {

    $sweeptakeOffer = SweeptakeOffer::find($sweeptake_id);

    $this->data = UserSweeptakeOffer::with('users')->where('sweeptake_offers_id', $sweeptake_id)->orderByRaw('RAND()')->take($sweeptakeOffer->no_of_winner)->get();
    if (count($this->data) > 0) {
        $this->response = TRUE;
        return response()->json(['response' => $this->response, 'data' => $this->data]);
    } else
        $this->error = 'Data is not Present';
    return response()->json(['response' => $this->response, 'error' => $this->error]);
}

    public function showWinnerUsersList($sweeptake, $id) {

        $users = Winner::with('user')->where('sweepstake_id', $id)->get();
        //return $users;
        $this->data = ucfirst(str_replace('_', ' ', $sweeptake));

        if (count($this->data) > 0) {
            $this->response = TRUE;
            return response()->json(['response' => $this->response, 'data' => $this->data]);
        } else
            $this->error = 'Data is not Present';
        return response()->json(['response' => $this->response, 'error' => $this->error]);
    }




    }


