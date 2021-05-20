<?php

namespace App\Providers;

use App\Models\Contact;
use App\Policies\ContactPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Contact::class => ContactPolicy::class,
    ];
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
        #Checkpoint
        Paginator::defaultView('vendor.pagination.tailwind');

        Paginator::defaultSimpleView('vendor.pagination.tailwind');
    }
}
