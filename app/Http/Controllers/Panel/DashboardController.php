<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends ApiBaseController
{

    private $service;
    private $label;

    public function __construct(DashboardService $service)
    {

        $this->service = $service;
        $this->label = 'Painel de Controle';
    }

    public function index(): View
    {

        return view('panel.home.index');
    }

    public function dashboard(): View
    {

        return view('panel.home.index');
    }

    public function reportUserRegistrationByDay(): JsonResponse
    {

        try {

            return $this->sendResponse($this->service->usersRegistrationDay());

        } catch (Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }


}

