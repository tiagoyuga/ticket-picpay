<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Group' => 'App\Policies\GroupPolicy',
        'App\Models\Client' => 'App\Policies\ClientPolicy',
        'App\Models\Ticket' => 'App\Policies\TicketPolicy',
        'App\Models\TicketStatus' => 'App\Policies\TicketStatusPolicy',
        'App\Models\TicketComment' => 'App\Policies\TicketCommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
