<?php
/**
 * @package    Controller
 ****************************************************
 * @date       09/12/2019 09:48:30
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\TypeStoreRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Models\Type;
use App\Services\TypeService;
use App\Traits\LogActivity;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class TypeController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(TypeService $service)
    {

        $this->service = $service;
        $this->label = 'Tipos de Usuários';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', Type::class);

        $data = $this->service->paginate(20);

        return view('panel.types.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', Type::class);

        $validatorRequest = new TypeStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.types.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(TypeStoreRequest $typeStoreRequest)
    {

        $this->service->create($typeStoreRequest->all());

        return redirect()->route('types.' . request('routeTo'))
            ->with([
                'message' => 'Successfully created',
                'messageType' => 's',
            ]);
    }

    public function edit(Type $type): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $type);

        $validatorRequest = new TypeUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.types.form')
            ->with([
                'item' => $type,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(TypeUpdateRequest $request, Type $type): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $type);

        return redirect()->route('types.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function destroy(Type $type): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!Auth::user()->can('delete', $type)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($type);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(Type $type): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $type);

        return response()->json($type, 200, [], JSON_PRETTY_PRINT);
    }
}
