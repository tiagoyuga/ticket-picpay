<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicUserRegistrationRequest;
use App\Http\Requests\UserDevRegistrationRequest;
use App\Models\Client;
use App\Models\ClientUser;
use App\Models\Group;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PublicController extends Controller
{

    public function registerDev(UserDevRegistrationRequest $request, UserService $userService)
    {

        $user = $userService->registerDev($request->all());

        Auth::login($user);
        return redirect('/panel/profile');
    }

    #public function registerPublic(User $user)
    public function registerPublic($user_id, UserService $userService)
    {

        $user = $userService->find(base64_decode($user_id));

        return view('public-users.form')
            ->with([
                'user' => $user,
            ]);
    }

    public function registerPublicUserStore(Request $request, UserService $userService, ClientUser $clientUser)
    {
        try {

            $request->request->set('name', $request->get('first_name').' '.$request->get('last_name'));

            $request->request->set('group_id', Group::CLIENT);

            $this->validate($request, (new PublicUserRegistrationRequest())->rules());

            $newUser = $userService->create($request->all());

            return redirect()->back()
                ->with([
                    'message' => 'Successfully created',
                    'messageType' => 's',
                ]);

        } catch (ValidationException $e) {

            return redirect()->back()->withInput($request->all())->withErrors($e->errors());
        }
    }
}
