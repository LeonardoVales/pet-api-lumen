<?php

namespace App\Providers;

use App\Repositories\AnimalRepository;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\Contracts\ServicoRepositoryInterface;
use App\Repositories\DonoRepository;
use App\Repositories\ServicoRepository;
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
        $this->app->bind(DonoRepositoryInterface::class, DonoRepository::class);
        $this->app->bind(AnimalRepositoryInterface::class, AnimalRepository::class);
        $this->app->bind(ServicoRepositoryInterface::class, ServicoRepository::class);
    }
}
