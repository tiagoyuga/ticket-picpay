<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\TicketCommentStoreRequest;
use App\Http\Requests\TicketCommentUpdateRequest;
use App\Models\TicketComment;
use App\Services\TicketCommentService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class TicketCommentController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(TicketCommentService $service)
    {

        $this->service = $service;
        $this->label = 'TicketComment';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', TicketComment::class);

        $data = $this->service->paginate(20);

        return view('panel.ticket_comments.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', TicketComment::class);

        $validatorRequest = new TicketCommentStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.ticket_comments.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(TicketCommentStoreRequest $ticketCommentStoreRequest)
    {

        $this->service->create($ticketCommentStoreRequest->all());

        return redirect()->route('ticket_comments.' . request('routeTo'))
            ->with([
                'message' => 'Successfully created',
                'messageType' => 's',
            ]);
    }

    public function edit(TicketComment $ticketComment): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $ticketComment);

        $validatorRequest = new TicketCommentUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.ticket_comments.form')
            ->with([
                'item' => $ticketComment,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(TicketCommentUpdateRequest $request, TicketComment $ticketComment): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $ticketComment);

        return redirect()->route('ticket_comments.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function destroy(TicketComment $ticketComment): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $ticketComment)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($ticketComment);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(TicketComment $ticketComment): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $ticketComment);

        return response()->json($ticketComment, 200, [], JSON_PRETTY_PRINT);
    }
}
