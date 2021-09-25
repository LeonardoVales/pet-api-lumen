<?php

namespace App\Providers;

use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\DonoRepository;
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
        // $this->app->bind(
        //     'App\Repositories\Contracts\DonoRepositoryInterface',
        //     'App\Repositories\DonoRepository'
        // );
        $this->app->bind(DonoRepositoryInterface::class, DonoRepository::class);
    }
}
