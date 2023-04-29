<?php

namespace App\Providers;

use App\Imports\CustomerImport;
use App\Services\CustomerService;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerService::class, function($app){
            return new CustomerService($app->make(EntityManagerInterface::class));
        });

        $this->app->bind(CustomerImport::class, function($app) {
            return new CustomerImport($app->make(CustomerService::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
