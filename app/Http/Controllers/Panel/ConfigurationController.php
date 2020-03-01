<?php
/**
 * @package    Controller
 ****************************************************
 * @date       25/11/2019 10:37:03
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\ConfigurationStoreRequest;
use App\Models\Configuration;
use App\Services\ConfigurationService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;
use Validator;

class ConfigurationController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(ConfigurationService $service)
    {

        $this->service = $service;
        $this->label = 'Configurações';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', Configuration::class);

        $data = $this->service->paginate(20);

        return view('panel.configurations.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', Configuration::class);

        $validatorRequest = new ConfigurationStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.configurations.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(ConfigurationStoreRequest $ConfigurationStoreRequest)
    {

        $this->service->create($ConfigurationStoreRequest->all());

        return redirect()->route('configurations.' . request('routeTo'))
            ->with([
                'message' => 'Successfully created',
                'messageType' => 's',
            ]);
    }

    public function edit(Configuration $configuration): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $configuration);

        $validatorRequest = new ConfigurationStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.configurations.form')
            ->with([
                'item' => $configuration,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(ConfigurationStoreRequest $request, Configuration $configuration): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $configuration);

        return redirect()->route('configurations.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function delete(Configuration $configuration): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            /*if (!Auth::user()->can('delete', $Configuration)) {

                return $this->sendUnauthorized();
            }*/

            $this->service->delete($configuration);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(Configuration $configuration): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $configuration);

        return response()->json($configuration, 200, [], JSON_PRETTY_PRINT);
    }


}
