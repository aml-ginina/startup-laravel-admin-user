<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProviderRequest;
use App\Repositories\ProviderRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Provider;
use Validator;
use Flash;
use Auth;
use Hash;
use App;
use DB;

class ProfileController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /** @var  ProviderRepository */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }

    public function index(Request $request)
    {
        $provider = Auth::guard('provider')->user();

        return view('provider.profile.index')
            ->with('provider', $provider)
            ->with('active', $request->active);
    }

    public function update(UpdateProviderRequest $request)
    {
        $provider = Auth::guard('provider')->user();

        $input = $request->only(['name', 'email', 'phone']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/providers'), $filename);
                $input['image'] = $filename;
            }
        }

        $provider = $this->providerRepository->update($input, $provider->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.profile')]));
        return redirect(route('provider.profile.index', ['active' => 'settings']));
    }

    public function password(Request $request)
    {
        $provider = Auth::guard('provider')->user();

        $rules = [
            'current_password' => 'required',
            'password' => 'required|min:8|max:255|confirmed'
        ];

        if(!Hash::check($request->current_password, $provider->password)) {
            $error = trans('passwords.dismatch');
            return redirect()->back()->withInput()->withErrors(['current_password' => $error]);
        }

        $input = ['password' => Hash::make($request->password)];

        $request->validate($rules);

        $provider = $this->providerRepository->update($input, $provider->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.password')]));
        return redirect(route('provider.profile.index', ['active' => 'password']));
    }
}
