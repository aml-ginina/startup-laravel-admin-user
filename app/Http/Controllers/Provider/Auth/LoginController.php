<?php

namespace App\Http\Controllers\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Provider;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:provider')->except('logout');
    }

    public function showLoginForm()
    {
        return view('provider.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = Provider::where('email', $request->email)->first();
        if(!is_null($user)) {
            if(!$user->approve) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => trans('auth.unapproved')
                ]);
            }
            if($user->block) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => __('auth.blocked')
                ]);
            }
        }

        if (Auth::guard('provider')->attempt($credentials, $request->get('remember'))) {
            return redirect()->intended(route('provider.home'));
        }
        
        return redirect()->back()->withInput()->withErrors([
            'email' => trans('auth.failed')
        ]);
    }
}
