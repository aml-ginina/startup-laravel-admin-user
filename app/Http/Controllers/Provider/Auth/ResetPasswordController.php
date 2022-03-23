<?php

namespace App\Http\Controllers\Provider\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Provider;
use Carbon\Carbon;
use Flash;
use Hash;
use DB;

class ResetPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:provider');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null              $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        if(!is_null($token)) {
            $updatePassword = DB::table('password_resets')->where([
                'email' => $request->email, 
                'token' => $token
            ])->first();

            if(!$updatePassword){
                return redirect()->route('provider.password.request')->withInput()->withErrors(['email', __('passwords.invalid')]);
            }
        }

        return view('provider.auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:providers,email',
            'password' => 'required|string|min:8|max:255|confirmed'
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email, 
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return redirect()->route('provider.password.request')->withInput()->withErrors(['email', __('passwords.invalid')]);
        }

        $provider = Provider::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        Flash::success(__('passwords.success'));
        return redirect()->route('provider.login');
    }
}
