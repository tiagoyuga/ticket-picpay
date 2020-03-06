<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicUserRegistrationRequest;
use App\Http\Requests\UserDevRegistrationRequest;
use App\Models\ClientUser;
use App\Models\Group;
use App\Services\ClientService;
use App\Services\ClientUserService;
use App\Services\UserService;
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

    public function registerPublic($client_id, ClientService $clientService )
    {
        $validator = \JsValidator::make((new PublicUserRegistrationRequest())->rulesModificada(), (new PublicUserRegistrationRequest())->messages());
        $client = $clientService->find(base64_decode($client_id));

        if (!$client) {
            abort('404');
        }

        return view('public-users.form')
            ->with([
                'client' => $client,
                'validator' => $validator,
            ]);
    }

    public function registerPublicUserStore(Request $request, UserService $userService, ClientUserService $clientUserService)
    {
        try {

            $request->request->set('name', $request->get('first_name').' '.$request->get('last_name'));

            $request->request->set('group_id', Group::CLIENT);

            $this->validate($request, (new PublicUserRegistrationRequest())->rulesModificada());

            $newUser = $userService->create($request->all());

            $request->request->set('user_id', $newUser->id);

            $clientUserService->create($request->all());

            if(!\Auth::id()){
                Auth::login($newUser);
                return redirect('/panel/tickets')->with([
                    'message' => 'Successfully',
                    'messageType' => 's',
                ]);
            }


            dd($user);

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
