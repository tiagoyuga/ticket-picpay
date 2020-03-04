<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/28/2020 7:30 AM
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use App\Services\ClientService;
use App\Services\UserService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class ClientController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(ClientService $service)
    {

        $this->service = $service;
        $this->label = 'Client';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', Client::class);

        $data = $this->service->paginate(20);

        return view('panel.clients.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(UserService $userService): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', Client::class);

        $validatorRequest = new ClientStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.clients.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
                'clientsList' => $userService->listsClients(),
                'devs' => $userService->listsDevs(),
                'usersList' => $userService->lists(),

            ]);
    }

    public function store(ClientStoreRequest $clientStoreRequest)
    {

        $this->service->create($clientStoreRequest->all());

        return redirect()->route('clients.' . request('routeTo'))
            ->with([
                'message' => 'Successfully created',
                'messageType' => 's',
            ]);
    }

    public function edit(Client $client, UserService $userService): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $client);

        $validatorRequest = new ClientUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.clients.form')
            ->with([
                'item' => $client,
                'label' => $this->label,
                'validator' => $validator,
                'clientsList' => $userService->listsClients(),
                'devs' => $userService->listsDevs(),
                'usersList' => $userService->lists(),
            ]);
    }

    public function update(ClientUpdateRequest $request, Client $client): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $client);

        return redirect()->route('clients.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function destroy(Client $client): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $client)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($client);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(Client $client): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $client);

        return response()->json($client, 200, [], JSON_PRETTY_PRINT);
    }
}
