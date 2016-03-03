<?php

namespace App\Providers;

use App\MyCart\Billers\CreditCardBiller;
use App\MyCart\Processors\OrderProcessor;
use App\MyCart\Repository\OrderRepository;
use App\MyCart\Validators\RecentOrderValidator;
use App\MyCart\Validators\SuspendedOrderValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app()->bind('BillerInterface', function(){
            return new CreditCardBiller();
        });

        app()->bind('OrderProcessor', function () {
            return new OrderProcessor(
                app()->make('BillerInterface'),
                app()->make(OrderRepository::class),
                [
                    app()->make(RecentOrderValidator::class),
                    app()->make(SuspendedOrderValidator::class)
                ]
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
