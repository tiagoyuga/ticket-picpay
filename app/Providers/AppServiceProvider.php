<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\CashbackCampaign;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Place;
use App\Models\PlaceReservation;
use App\Models\Sale;
use App\Models\Sport;
use App\Models\StatusSaleSale;
use App\Models\Type;
use App\Models\User;
use App\Observers\AddressObserver;
use App\Observers\CashbackCampaignObserver;
use App\Observers\CategoryObserver;
use App\Observers\CouponObserver;
use App\Observers\PlaceObserver;
use App\Observers\PlaceReservationObserver;
use App\Observers\SaleObserver;
use App\Observers\SportObserver;
use App\Observers\StatusSaleSaleObserver;
use App\Observers\TypeObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (env('FORCE_HTTPS')) {

            URL::forceScheme('https');
        }

        User::observe(UserObserver::class);
       // Type::observe(TypeObserver::class);

    }
}
