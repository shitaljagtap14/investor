<?php

namespace App\Http\Controllers;

use App\Forms\SweepstakeForm;
use App\Models\Sweepstake;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Laracasts\Flash\Flash;
use App\Models\User;
use App\Models\Transactions;
use DB;
class SweepstakesController extends Controller
{
    /**
     * SweepstakesController constructor.
     */
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
        $sweepstakes = Sweepstake::all();
     //   $sweeptakebyuser=Transactions::all();
      //  return $sweeptakebyuser;
      //  $user_info = DB::table('transaction')
          //  ->select('item_number')
         //   ->get();
     //  return $user_info;
     //   $sweeptakeWinners = Transactions::with('sweepstakes')->where('sweeptake_offers_id', $sweeptake_id)->orderByRaw('RAND()')->take($sweeptakeOffer->no_of_winner)->get();

     //   return $sweeptakeWinners;
        if ($this->user->is_admin) {
            return $this->render('admin.sweepstake.index', compact('sweepstakes'));
        } else {
            return $this->render('user.userSweeptakes', compact('sweepstakes'));

        }
    }

    /**
     * Get Sweepstake Form
     *
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(SweepstakeForm::class, [
            'method' => 'POST',
            'url' => url("sweepstakes/add"),
            'class' => 'form-horizontal',
            'role' => "form"
        ]);
        return $this->render('admin.sweepstake.add', compact('form'));
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdd(Request $request, FormBuilder $formBuilder)
    {
        $entrylevel = $request->get('entry_level');
        $pointdata = Sweepstake::where('subscription_id', $entrylevel)->get();

        $form = $formBuilder->create(SweepstakeForm::class);
        if ($pointdata->isEmpty()) {
        if (!$form->isValid()) {
            Flash::error('Please remove the error and try again!');
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        } else {
            Sweepstake::create([
                'subscription_id' => $request->get('entry_level'),
                'entry_point' => $request->get('entry_point'),
            ]);
            Flash::success('Sweepstake created successfully.');
            return redirect('sweepstakes');
        }
        }
        else
        {
            Flash::error('This Package is Allready Present');
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit(Request $request, FormBuilder $formBuilder)
    {
        $sweepstake = Sweepstake::find($request->get('id'));

        if (!$sweepstake) {
            Flash::error('Record does not exist!');
            return redirect()->back();
        }

        $form = $formBuilder->create(SweepstakeForm::class, [
            'method' => 'POST',
            'url' => url("sweepstakes/edit?id={$sweepstake->id}"),
            'class' => 'form-horizontal',
            'role' => "form"
        ], array('sweepstake' => $sweepstake));

        return $this->render('admin.sweepstake.edit', compact('form'));
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, FormBuilder $formBuilder)
    {
        $sweepstake = Sweepstake::find($request->get('id'));

        if (!$sweepstake) {
            Flash::error('Record does not exist!');
            return redirect()->back();
        }

        $form = $formBuilder->create(SweepstakeForm::class, [], array('sweepstake' => $sweepstake));
        if (!$form->isValid()) {
            Flash::error('Please remove the error and try again!');
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        } else {
            $sweepstake->subscription_id = $request->get('entry_level');
            $sweepstake->entry_point = $request->get('entry_point');
            $sweepstake->save();
            Flash::info('Swepstake updated successfully.');
            return redirect()->back();
        }
    }

    public function getDelete(Request $request)
    {
        $sweepstake = Sweepstake::find($request->get('id'));
        if ($sweepstake) {
            $sweepstake->delete();
            Flash::success('Sweepstake deleted successfully');
            return 'ok';
        } else {
            return 'no';
        }
    }


    public function buyData(Request $request)
    {
        $sweepstake = Sweepstake::find($request->get('id'));
        return $sweepstake;

      //  return $this->render('admin.sweepstake.edit', compact('form'));
    }





















}
