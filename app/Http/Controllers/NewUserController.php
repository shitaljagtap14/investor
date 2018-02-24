<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PurchaseCoin;
use App\Models\Subscription;
use App\Models\Sweepstake;
use App\Models\UserSweeptakeOffer;
use App\Models\SweeptakeOffer;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class NewUserController extends Controller
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
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();

    }


    public function getIndex(Request $request)
    {
             $userdata = User::where('is_admin', 0)->get();
        return $this->render('admin.user.index', compact('userdata'));
    }


    public function getUserdata()
    {
        $userData = User::where('is_admin', 0)->get();
        return $this->render('admin.user', compact('userData'));
    }


    public function getAdd()
    {
        return $this->render('admin.user.add');
    }

    public function postAdd(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {
            User::create([

                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
            Flash::success('User created successfully.');
            return redirect('user');

        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }


    public function getDelete(Request $request)
    {
        $userData = User::find($request->get('id'));
        if ($userData) {
            $userData->delete();
            Flash::success('User deleted successfully');
            return 'ok';
        } else {
            return 'no';
        }
    }

    public function getUserByID($id){
        $response=User::find($id);
        return $response;
    }

}


