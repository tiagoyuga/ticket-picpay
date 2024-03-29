<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/25/2020 8:56 PM
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\ClientUser;
use App\Models\Group;
use App\Models\TicketFile;
use App\Models\Type;
use App\Models\User;
use App\Services\DevSkillCategoryService;
use App\Services\GroupService;
use App\Services\UserService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use JsValidator;

class UserController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(UserService $service)
    {

        $this->service = $service;
        $this->label = 'User';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', User::class);

        $user = \Auth::user();

        if($user->group_id == Group::CLIENT) {

            foreach($user->usersTypeClient as $client) {
                \request()->request->add(['client_id' => $client->id]);
                \request()->request->add(['group_id' => Group::CLIENT]);

                $client_type = ClientUser::where('client_id', $client->id)->where('user_id', $user->id)->first();
                if($client_type->is_admin != 1)
                    continue;

                $data[$client->id]['name'] = $client->company_name;
                $data[$client->id]['data'] = $this->service->paginate(20);

            }


        }else if($user->group_id == Group::ADMIN) {
            $data = $this->service->paginate(20);
        }else{
            abort('404', 'forbidden');
        }

        return view('panel.users.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(GroupService $groupService): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', User::class);

        $validatorRequest = new UserStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.users.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
                'groupList' => $groupService->lists(),
                'projectManagerList' => [],
                'clientList' => [],
            ]);
    }

    public function store(UserStoreRequest $userStoreRequest)
    {

        $this->service->create($userStoreRequest->all());

        return redirect()->route('users.' . request('routeTo'))
            ->with([
                'message' => 'Successfully created',
                'messageType' => 's',
            ]);
    }

    public function edit(User $user, GroupService $groupService): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $user);

        $validatorRequest = new UserUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.users.form')
            ->with([
                'item' => $user,
                'label' => $this->label,
                'validator' => $validator,
                'groupList' => $groupService->lists(),
                'projectManagerList' => [],
                'clientList' => [],
            ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {

        $this->service->update($request->all(), $user);

        return redirect()->route('users.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function updateSkills(Request $request, User $user): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->updateSkills($request->all(), $user);

        return redirect()->route('users.index')
            ->with([
                'message' => 'Successfully updated',
                'messageType' => 's',
            ]);
    }

    public function destroy(User $user): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $user)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($user);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(User $user): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $user);

        return response()->json($user, 200, [], JSON_PRETTY_PRINT);
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

    public function listToClientAdmim() : View
    {
        if(!Auth::user()->isClientAdmin) {
            abort('404');
        }

        return view('panel.users.index-client-admim');
    }

    public function changeUserPrivileges(UserService $userService) : JsonResponse
    {

        try {
            if (!Auth::user()->isAdmin && !Auth::user()->isClientAdmin) {
                abort('404');
            }

            $userCompany = $userService->changeUserPrivileges((int)request()->get('user_id'), (int)request()->get('client_id'));
            $data = [
                'error' => false,
                'data' => $userCompany->is_admin,
            ];

            return response()->json($data, 200, [], JSON_PRETTY_PRINT);

            /*return redirect()->route('users.listToClientAdmim')
                ->with([
                    'message' => 'Successfully updated',
                    'messageType' => 's',
                ]);*/

        } catch (Exception $e) {

            $data = [
                'error' => true,
                'mensage' => $e->getMessage()
            ];

            return response()->json($data, 500, [], JSON_PRETTY_PRINT);
        }
    }
}
