<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
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
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();

    }

    public function getEdit()
    {
        return $this->render('auth.editProfile');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $user = User::find($this->user->id);
        if ($user) {
            $user->name = $request->get('name');
            $user->first_name = $request->get('firstname');
            $user->last_name = $request->get('lastname');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
            Flash::info('User has been updated successfully');
        } else {
            Flash::error('User authentication failed!');
        }
        return redirect()->back();
    }

}
