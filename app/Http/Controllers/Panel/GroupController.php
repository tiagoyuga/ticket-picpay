<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Models\Group;
use App\Services\GroupService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use JsValidator;

class GroupController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(GroupService $service)
    {

        $this->service = $service;
        $this->label = 'Group';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', Group::class);

        $data = $this->service->paginate(20);

        return view('panel.groups.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', Group::class);

        $validatorRequest = new GroupStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.groups.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(Request $request)
    {
        try {

            $this->validate($request, (new GroupStoreRequest())->rulesGroup());

            $this->service->create($request->all());

            return redirect()->route('groups.' . request('routeTo'))
                ->with([
                    'message' => 'Successfully created',
                    'messageType' => 's',
                ]);

        } catch (ValidationException $e) {

            return redirect()->back()->withInput($request->all())->withErrors($e->errors());
        }
    }

    public function edit(Group $group): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $group);

        $validatorRequest = new GroupUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.groups.form')
            ->with([
                'item' => $group,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(Request $request, Group $group): RedirectResponse
    {
        try {

            $this->log(__METHOD__);

            $this->validate($request, (new GroupUpdateRequest())->rulesGroup());

            $this->service->update($request->all(), $group);

            return redirect()->route('groups.index')
                ->with([
                    'message' => 'Successfully updated',
                    'messageType' => 's',
                ]);

        } catch (ValidationException $e) {

            return redirect()->back()->withInput($request->all())->withErrors($e->errors());
        }
    }

    public function destroy(Group $group): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $group)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($group);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(Group $group): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $group);

        return response()->json($group, 200, [], JSON_PRETTY_PRINT);
    }
}
