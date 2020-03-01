<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDevRegistrationRequest;
use App\Services\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{

    public function registerDev(UserDevRegistrationRequest $request, UserService $userService)
    {

        $user = $userService->registerDev($request->all());

        Auth::login($user);
        return redirect('/panel/profile');
    }
}
