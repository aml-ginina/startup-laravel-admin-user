<?php

namespace App\Http\Controllers\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Flash;
use Auth;
use Mail;
use Hash;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | provider that recently registered with the application. Emails may also
    | be re-sent if the provider didn't receive the original email message.
    |
    */

    /** @var ProviderRepository $providerRepository*/
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        $provider = $this->providerRepository->find($request->id);
        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect()->route('provider.login');
        }

        return view('provider.auth.verify')->with('provider', $provider);
    }

    public function send($id)
    {
        $provider = $this->providerRepository->find($id);
        if (empty($provider)) {
            $error = __('messages.not_found', ['model' => __('models/providers.singular')]);
            return response()->json(['success' => false, 'message' => $error]);
        }

        $hash = Str::random(10);
        $provider = $this->providerRepository->update(['email_verification_code' => $hash], $id);

        try {
            Mail::send('emails.verify', [
                'url' => route('provider.verification.verify', ['id' => $provider->id, 'hash' => Hash::make($hash)])
            ], function ($message) use ($provider) {
                $message->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                $message->to($provider->email, $provider->name);
                $message->subject(__('auth.verify_email.title'));
                $message->priority(1);
            });
        } catch (\Throwable $th) {            
            return response()->json(['success' => false, 'message' => __('auth.verify_email.error_sending')]);
        }
        

        return response()->json(['success' => true, 'message' => __('auth.verify_email.success')]);
    }

    public function resend(Request $request)
    {
        $send = $this->send($request->id);
        $data = $send->getData();
        if(!$data->success) {
            Flash::error($data->message);
        } else {
            Flash::success($data->message);
        }

        return redirect()->route('provider.verification.notice', ['id' => $request->id]);
    }

    public function verify($id, Request $request)
    {
        $provider = $this->providerRepository->find($id);
        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect()->route('provider.login');
        }

        if(!Hash::check($provider->email_verification_code, $request->hash)) {
            Flash::error(__('auth.verify_email.error'));
            return redirect()->route('provider.verification.notice', ['id' => $id]);
        }

        $provider = $this->providerRepository->update(['email_verified_at' => Carbon::now()->format('Y-m-d')], $id);

        Flash::success(__('auth.verify_email.verify_success'));
        return redirect()->route('provider.login');
    }
}