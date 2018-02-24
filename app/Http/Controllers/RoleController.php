<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();

    }

    public function getIndex(Request $request)
    {
        $roledata = Role::all();

        return $this->render('admin.role.index', compact('roledata'));
    }


    public function getAdd()
    {
        return $this->render('admin.role.add');
    }

    public function postAdd(Request $request)
    {
        $rules = [
            'role' => 'required|max:255',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {
            Role::create([

                'role' => $request->get('role'),
            ]);
            Flash::success('Role created successfully.');
            return redirect('role');

        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }

    public function getEdit(Request $request)
    {
        $roledata = Role::find($request->get('id'));
        if (!$roledata) {
            Flash::error('Role not found');
            return redirect()->back();
        }
        return $this->render('admin.role.edit', compact('roledata'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $roledata = Role::find($request->get('id'));
        if (!$roledata) {
            Flash::error('Role not found');
            return redirect()->back();
        }

        $rules = [

            'role' => 'required',

        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {


            $roledata->role = $request->get('role');
            $roledata->save();
            Flash::info('Role has been updated successfully');
            return redirect()->back();
        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }

    public function getDelete(Request $request)
    {
        $roledata = Role::find($request->get('id'));
        if ($roledata) {
            $roledata->delete();
            Flash::success('Role deleted successfully');
            return 'ok';
        } else {
            return 'no';
        }
    }
}
