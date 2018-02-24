<?php

namespace App\Http\Controllers;

use App\Models\PurchaseCoin;
use App\Forms\PurchaseCoinForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kris\LaravelFormBuilder\FormBuilder;
use Laracasts\Flash\Flash;

class PurchaseCoinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        parent::__construct();
    }

    public function getIndex(Request $request)
    {
        $purchase = PurchaseCoin::all();
        if ($this->user->is_admin) {
            return $this->render('admin.purchase.index', compact('purchase'));
        } else {
            return $this->render('user.userpurchase', compact('purchase'));
        }
    }


    public function getAdd(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PurchaseCoinForm::class, [
            'method' => 'POST',
            'url' => url("purchase/add"),
            'class' => 'form-horizontal',
            'role' => "form"
        ]);
        return $this->render('admin.purchase.add', compact('form'));
    }

    public function postAdd(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PurchaseCoinForm::class);
        if (!$form->isValid()) {
            Flash::error('Please remove the error and try again!');
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        } else {
            PurchaseCoin::create([
                'reword_point' => $request->get('reword_point'),
                'additional_point' => $request->get('additional_point'),
                'amount' => $request->get('amount'),
            ]);
            Flash::success('purchase created successfully.');
            return redirect('purchase');
        }
    }

    public function getEdit(Request $request, FormBuilder $formBuilder)
    {
        $purchase = PurchaseCoin::find($request->get('id'));

        if (!$purchase) {
            Flash::error('Record does not exist!');
            return redirect()->back();
        }

        $form = $formBuilder->create(PurchaseCoinForm::class, [
            'method' => 'POST',
            'url' => url("purchase/edit?id={$purchase->id}"),
            'class' => 'form-horizontal',
            'role' => "form"
        ], array('purchase' => $purchase));

        return $this->render('admin.purchase.edit', compact('form'));
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, FormBuilder $formBuilder)
    {
        $purchase = PurchaseCoin::find($request->get('id'));

        if (!$purchase) {
            Flash::error('Record does not exist!');
            return redirect()->back();
        }

        $form = $formBuilder->create(PurchaseCoinForm::class, [], array('purchase' => $purchase));
        if (!$form->isValid()) {
            Flash::error('Please remove the error and try again!');
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        } else {
            $purchase->reword_point = $request->get('reword_point');
            $purchase->additional_point = $request->get('additional_point');
            $purchase->amount = $request->get('amount');
            $purchase->save();
            Flash::info('Purchase updated successfully.');
            return redirect()->back();
        }
    }

    public function getDelete(Request $request)
    {
        $purchase = PurchaseCoin::find($request->get('id'));
        if ($purchase) {
            $purchase->delete();
            Flash::success('purchase deleted successfully');
            return 'ok';
        } else {
            return 'no';
        }
    }

}
