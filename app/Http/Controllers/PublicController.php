<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicUserRegistrationRequest;
use App\Http\Requests\UserDevRegistrationRequest;
use App\Models\Client;
use App\Models\ClientUser;
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

    public function registerPublic(Client $client)
    {

        return view('public-users.form')
            ->with([
                'client' => $client,
            ]);
    }

    public function registerPublicUserStore(Request $request, UserService $userService, ClientUser $clientUser)
    {
        try {

            $request->request->set('name', $request->get('first_name').' '.$request->get('last_name'));
            #$request->request->set('group_id', 1);

            $this->validate($request, (new PublicUserRegistrationRequest())->rules());

            $newUser = $userService->create($request->all());

            $request->request->set('user_id', $newUser->id);

            $userService->createClientUser($request->all());

            return redirect()->route('users.' . request('routeTo'))
                ->with([
                    'message' => 'Successfully created',
                    'messageType' => 's',
                ]);

        } catch (ValidationException $e) {

            return redirect()->back()->withInput($request->all())->withErrors($e->errors());
        }
    }
}
