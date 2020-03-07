<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\TicketChangeStatusRequest;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\TicketFile;
use App\Models\TicketStatus;
use App\Services\TicketService;
use App\Services\UserService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use JsValidator;

class TicketController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(TicketService $service)
    {

        $this->service = $service;
        $this->label = 'Ticket Center';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', Ticket::class);

        switch (\Auth::user()->group_id){
            case 1:
                $url = 'panel.tickets.index-admin';
                break;
            case 3:
                $url = 'panel.tickets.index-client';
                break;
            case 4:
                $url = 'panel.tickets.index-cto';
                break;
            case 5:
                $url = 'panel.tickets.index-dev';
                break;

        }

        if(Auth::user()->getIsClientAttribute()) {

            if(Auth::user()->isClientAdmim()) {
                $data = $this->service->paginateTicketsForClientAdmin(20);
            } else {
                $data = $this->service->paginateTicketsForClient(20);
            }
        } else {

            $data = $this->service->paginate(20);
        }

        return view($url)
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', Ticket::class);


        $validatorRequest = new TicketStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.tickets.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(TicketStoreRequest $ticketStoreRequest)
    {

        $this->service->create($ticketStoreRequest->all());

        return redirect()->route('tickets.' . request('routeTo'))
            ->with([
                'message' => 'Successfully created',
                'messageType' => 's',
            ]);
    }

    public function details(Ticket $ticket): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $ticket);

        $validatorRequest = new TicketUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.tickets.details')
            ->with([
                'item' => $ticket,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function changeStatus(Ticket $ticket, UserService $userService): View
    {

        $this->log(__METHOD__);

        $this->authorize('changeStatus', $ticket);

        return view('panel.tickets.change_status')
            ->with([
                'item' => $ticket,
                'label' => $this->label,
                'devs' => $userService->listsDevs(),
                'status' => TicketStatus::pluck('name','id'),
            ]);
    }

    public function edit(Ticket $ticket): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $ticket);

        $validatorRequest = new TicketUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.tickets.form')
            ->with([
                'item' => $ticket,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $ticket);

        return redirect()->route('tickets.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $ticket)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($ticket);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(Ticket $ticket): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $ticket);

        return response()->json($ticket, 200, [], JSON_PRETTY_PRINT);
    }

    public function download(TicketFile $attachment)
    {

        $this->log(__METHOD__);

        try {

            $filename = 'document_'.\Carbon\Carbon::now();
            $contentType = mime_content_type(storage_path('app/' . $attachment->file));

            if ($contentType == 'application/pdf') {

                return response()->file(storage_path('app/' . $attachment->file), [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $filename . '"'
                ]);
            }

            return response()->download(storage_path('app/' . $attachment->file), $filename);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }
}
