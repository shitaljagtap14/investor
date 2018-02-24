<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraSweeptake;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class ExtraSweeptakeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();

    }

    public function getIndex(Request $request)
    {
        $extrasweepdata = ExtraSweeptake::all();
        if ($this->user->is_admin) {
            return $this->render('admin.extra_sweeptake.index', compact('extrasweepdata'));
        } else {
            return $this->render('user.extraSweeptake', compact('extrasweepdata'));

        }
    }


    public function getAdd()
    {
        return $this->render('admin.extra_sweeptake.add');
    }

    public function postAdd(Request $request)
    {
        $rules = [
            'amount' => 'required|max:255',
            'entry_point' => 'required|max:255',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {
            ExtraSweeptake::create([

                'amount' => $request->get('amount'),
                'entry_point' => $request->get('entry_point'),
            ]);
            Flash::success('Sweeptake created successfully.');
            return redirect('extrasweeptake');

        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }

    public function getEdit(Request $request)
    {
        $extrasweepdata = ExtraSweeptake::find($request->get('id'));
        if (!$extrasweepdata) {
            Flash::error('extrasweeptake not found');
            return redirect()->back();
        }
        return $this->render('admin.extra_sweeptake.edit', compact('extrasweepdata'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $extrasweepdata = ExtraSweeptake::find($request->get('id'));
        if (!$extrasweepdata) {
            Flash::error('extrasweeptake not found');
            return redirect()->back();
        }

        $rules = [

            'amount' => 'required',
            'entry_point' => 'required',

        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {


            $extrasweepdata->amount = $request->get('amount');
            $extrasweepdata->entry_point = $request->get('entry_point');
            $extrasweepdata->save();
            Flash::info('Extra Sweeptake has been updated successfully');
            return redirect()->back();
        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }

    public function getDelete(Request $request)
    {
        $extrasweepdata = ExtraSweeptake::find($request->get('id'));
        if ($extrasweepdata) {
            $extrasweepdata->delete();
            Flash::success('Extra Sweeptake deleted successfully');
            return 'ok';
        } else {
            return 'no';
        }
    }
}
