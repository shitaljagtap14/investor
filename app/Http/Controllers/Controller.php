<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Logged In User
     * @var \App\Models\User
     */
    protected $user = null;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->setEnv();
            return $next($request);
        });
    }

    /**
     * Set User Env
     */
    protected function setEnv()
    {
        $this->user = Auth::user();
    }

    /**
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view, $data = [])
    {
       // $data['subscriptions'] = Subscription::all()->count();
        $data['user'] = $this->user;
        return view($view, $data);
    }
}
