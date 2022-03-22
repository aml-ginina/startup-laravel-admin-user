<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Repositories\ProviderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Hash;
use DB;

class ProviderController extends AppBaseController
{
    /** @var ProviderRepository $providerRepository*/
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }

    /**
     * Display a listing of the Provider.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $providers = $this->providerRepository->all($request->all());

        return view('admin.providers.index')
            ->with('providers', $providers);
    }

    /**
     * Show the form for creating a new Provider.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created Provider in storage.
     *
     * @param CreateProviderRequest $request
     *
     * @return Response
     */
    public function store(CreateProviderRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        if(!$request->block) $input['block_notes'] = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/providers'), $filename);
                $input['image'] = $filename;
            }
        }
        $provider = $this->providerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/providers.singular')]));
        return redirect(route('admin.providers.index'));
    }

    /**
     * Display the specified Provider.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect(route('admin.providers.index'));
        }

        return view('admin.providers.show')->with('provider', $provider);
    }

    /**
     * Show the form for editing the specified Provider.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect(route('admin.providers.index'));
        }

        return view('admin.providers.edit')->with('provider', $provider);
    }

    /**
     * Update the specified Provider in storage.
     *
     * @param int $id
     * @param UpdateProviderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProviderRequest $request)
    {
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect(route('admin.providers.index'));
        }

        DB::beginTransaction();

        $input = $request->except('password');
        if(!is_null($request->password)) $input['password'] = Hash::make($request->password);
        if(!$request->block) $input['block_notes'] = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/providers'), $filename);
                $input['image'] = $filename;
            }
        }

        $provider = $this->providerRepository->update($input, $id);

        if($provider->isDirty('approve') && $provider->approve) {
            try {
                Mail::send('emails.message', [
                    'text' => "Your account is approved, you can now login to your dashboard : <a href=\"" . route('provider.login') . "\" >".route('provider.login')."</a>"
                ], function ($message) use ($provider) {
                    $message->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                    $message->to($provider->email, $provider->name);
                    $message->subject(__('models/providers.approved'));
                    $message->priority(1);
                });
            } catch (\Throwable $th) {            
                return response()->json(['success' => false, 'message' => __('auth.verify_email.error_sending')]);
            }
        }

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/providers.singular')]));
        return redirect(route('admin.providers.index'));
    }

    /**
     * Remove the specified Provider from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect(route('admin.providers.index'));
        }

        $this->providerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/providers.singular')]));
        return redirect(route('admin.providers.index'));
    }
}
