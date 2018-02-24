<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class SubscriptionsController extends Controller
{
    /**
     * SubscriptionsController constructor.
     */


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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $subscriptions = Subscription::where('status','active')->get();
        if ($this->user->is_admin) {
            return $this->render('admin.subscription.index', compact('subscriptions'));


        } else {
            return $this->render('user.userdashboard', compact('subscriptions'));
        }
    }

    /**
     * Add Subscription Form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $packages = [
            'member' => 'Member',
            'silver' => 'Silver',
            'gold' => 'Gold',
            'platinum' => 'Platinum',
            'diamond' => 'Diamond',
            'other' => 'Other',
        ];
        $options = ['active' => 'Active', 'suspended' => 'Suspended'];
        return $this->render('admin.subscription.add', compact('packages', 'options'));
    }

    /**
     * Post Add Subscription Form
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdd(Request $request)
    {
        $packagedetails = $request->get('package');
        $pointdata = Subscription::where('package', $packagedetails)->get();

        if ($pointdata->isEmpty()) {
            $rules = [
                'package' => 'required|string|max:50',
                'amount' => 'required',
                'reward_point' => 'required',
                'bonus_point' => 'required',
                'extra_point' => 'required',
                'interest' => 'required',
                'status' => 'required',
                'status_level' => 'required'
            ];
            $validate = Validator::make($request->all(), $rules);
            if ($validate->valid()) {
                Subscription::create([
                    'package' => ($request->get('custom_package')) ?: $request->get('package'),
                    'amount' => $request->get('subscription_amt'),
                    'reward_point' => $request->get('reward_point'),
                    'bonus_point' => $request->get('bonus_point'),
                    'extra_point' => $request->get('extra_point'),
                    'interest' => $request->get('interest'),
                    'status' => $request->get('active_status'),
                    'status_level' => $request->get('status_level')
                ]);
                Flash::success('Subscription created successfully.');
                return redirect('subscription');


            } else {
                Flash::error('Please remove the errors and submit again.');
                return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
            }
        }
        else
            Flash::error('This Package is Allready Present');
        return redirect()->back();
    }
    /**
     * Edit Subscription Form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit(Request $request)
    {
        $subscription = Subscription::find($request->get('id'));
        if (!$subscription) {
            Flash::error('Subscription not found');
            return redirect()->back();
        }
        $packages = [
            'member' => 'Member',
            'silver' => 'Silver',
            'gold' => 'Gold',
            'platinum' => 'Platinum',
            'diamond' => 'Diamond',
            'other' => 'Other',
        ];
        $options = ['active' => 'Active', 'suspended' => 'Suspended'];
        return $this->render('admin.subscription.edit', compact('subscription', 'packages', 'options'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $subscription = Subscription::find($request->get('id'));
        if (!$subscription) {
            Flash::error('Subscription not found');
            return redirect()->back();
        }

        $rules = [
            'package' => 'required|string|max:50',
            'amount' => 'required',
            'reward_point' => 'required',
            'bonus_point' => 'required',
            'extra_point' => 'required',
            'interest' => 'required',
            'status' => 'required',
            'status_level' => 'required'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->valid()) {
            $subscription->package = ($request->get('custom_package')) ?: $request->get('package');
            $subscription->amount = $request->get('subscription_amt');
            $subscription->reward_point = $request->get('reward_point');
            $subscription->bonus_point = $request->get('bonus_point');
            $subscription->extra_point = $request->get('extra_point');
            $subscription->interest = $request->get('interest');
            $subscription->status = $request->get('active_status');
            $subscription->status_level = $request->get('status_level');
            $subscription->save();
            Flash::info('Subscription has been updated successfully');
            return redirect()->back();
        } else {
            Flash::error('Please remove the errors and submit again.');
            return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getDelete(Request $request)
    {
        $subscription = Subscription::find($request->get('id'));
        if ($subscription) {
            $subscription->delete();
            Flash::success('Subscription deleted successfully');
            return 'ok';
        } else {
            return 'no';
        }
    }

}
