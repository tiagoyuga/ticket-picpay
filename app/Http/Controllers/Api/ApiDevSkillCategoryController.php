<?php
/**
 * @package    Api
 ****************************************************
 * @date       02/25/2020 8:08 PM
 */

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\DevSkillCategoryStoreRequest;
use App\Http\Requests\DevSkillCategoryUpdateRequest;
use App\Http\Resources\DevSkillCategoryCollection;
use App\Http\Resources\DevSkillCategoryResource;
use App\Services\DevSkillCategoryService;
use Illuminate\Http\JsonResponse;
use Validator;

class ApiDevSkillCategoryController extends ApiBaseController
{

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DevSkillCategoryService $service
     */
    public function __construct(DevSkillCategoryService $service)
    {

        $this->middleware('jwt.auth');
        $this->service = $service;
    }

    /**
     * Paginate.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        try {

            $limit = (int)(request('limit') ?? 20);
            $data = $this->service->paginate($limit);

            return $this->sendPaginate(new DevSkillCategoryCollection($data));

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }

    /**
     * return all.
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {

        try {

            $data = $this->service->all();

            return $this->sendResource(DevSkillCategoryResource::collection($data));

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);
        }
    }

    /**
     * Find detail using id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {

        try {

            $item = $this->service->find($id);
            if ($item === null) {

                return $this->sendNotFound();
            }

            return $this->sendResource(new DevSkillCategoryResource($item));

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }

    /**
     * Store.
     *
     * @return JsonResponse
     */
    public function store()
    {
        try {

            if (!\Auth::user()->can('create', DevSkillCategory::class)) {

                return $this->sendUnauthorized();
            }

            $storeRequest = new DevSkillCategoryStoreRequest();
            $validator = Validator::make(request()->all(), $storeRequest->rules());

            if ($validator->fails()) {

                return $this->sendBadRequest('Validation Error.', $validator->errors()->toArray());
            }

            $item = $this->service->create(request()->all());

            return $this->sendResponse($item->toArray());

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }

    /**
     * Update.
     *
     * @return JsonResponse
     */
    public function update()
    {
        try {

            $item = $this->service->find($id);
            if ($item === null) {

                return $this->sendNotFound();
            }

            if (!\Auth::user()->can('update', DevSkillCategory::class)) {

                return $this->sendUnauthorized();
            }

            $updateRequest = new DevSkillCategoryUpdateRequest();
            $validator = Validator::make(request()->all(), $updateRequest->rules());

            if ($validator->fails()) {

                return $this->sendBadRequest('Validation Error.', $validator->errors()->toArray());
            }

            $item = $this->service->update(request()->all(), $item);

            return $this->sendResponse($item->toArray());

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }
}
