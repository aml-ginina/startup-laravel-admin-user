<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProviderAPIRequest;
use App\Http\Requests\API\UpdateProviderAPIRequest;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProviderController
 * @package App\Http\Controllers\API
 */

class ProviderAPIController extends AppBaseController
{
    /** @var  ProviderRepository */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }

    /**
     * Display a listing of the Provider.
     * GET|HEAD /providers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $providers = $this->providerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $providers->toArray(),
            __('messages.retrieved', ['model' => __('models/providers.plural')])
        );
    }

    /**
     * Store a newly created Provider in storage.
     * POST /providers
     *
     * @param CreateProviderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProviderAPIRequest $request)
    {
        $input = $request->all();

        $provider = $this->providerRepository->create($input);

        return $this->sendResponse(
            $provider->toArray(),
            __('messages.saved', ['model' => __('models/providers.singular')])
        );
    }

    /**
     * Display the specified Provider.
     * GET|HEAD /providers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/providers.singular')])
            );
        }

        return $this->sendResponse(
            $provider->toArray(),
            __('messages.retrieved', ['model' => __('models/providers.singular')])
        );
    }

    /**
     * Update the specified Provider in storage.
     * PUT/PATCH /providers/{id}
     *
     * @param int $id
     * @param UpdateProviderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProviderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/providers.singular')])
            );
        }

        $provider = $this->providerRepository->update($input, $id);

        return $this->sendResponse(
            $provider->toArray(),
            __('messages.updated', ['model' => __('models/providers.singular')])
        );
    }

    /**
     * Remove the specified Provider from storage.
     * DELETE /providers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/providers.singular')])
            );
        }

        $provider->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/providers.singular')])
        );
    }
}
