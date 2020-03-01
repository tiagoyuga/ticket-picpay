<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:47 AM
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\TicketStatusStoreRequest;
use App\Http\Requests\TicketStatusUpdateRequest;
use App\Models\TicketStatus;
use App\Services\TicketStatusService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class TicketStatusController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(TicketStatusService $service)
    {

        $this->service = $service;
        $this->label = 'TicketStatus';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', TicketStatus::class);

        $data = $this->service->paginate(20);

        return view('panel.ticket_status.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', TicketStatus::class);

        $validatorRequest = new TicketStatusStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.ticket_status.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(TicketStatusStoreRequest $ticketStatusStoreRequest)
    {

        $this->service->create($ticketStatusStoreRequest->all());

        return redirect()->route('ticket_status.' . request('routeTo'))
            ->with([
                'message' => 'Successfully created',
                'messageType' => 's',
            ]);
    }

    public function edit(TicketStatus $ticketStatus): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $ticketStatus);

        $validatorRequest = new TicketStatusUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.ticket_status.form')
            ->with([
                'item' => $ticketStatus,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(TicketStatusUpdateRequest $request, TicketStatus $ticketStatus): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $ticketStatus);

        return redirect()->route('ticket_status.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function destroy(TicketStatus $ticketStatus): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $ticketStatus)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($ticketStatus);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(TicketStatus $ticketStatus): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $ticketStatus);

        return response()->json($ticketStatus, 200, [], JSON_PRETTY_PRINT);
    }
}
