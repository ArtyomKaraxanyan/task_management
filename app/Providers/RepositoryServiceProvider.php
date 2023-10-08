<?php

namespace App\Providers;

use App\Repositories\Eloquent;

use App\Repositories\Interfaces\TaskInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\WorkspaceInterface;
use App\Repositories\Eloquent\WorkspaceRepository;
use App\Repositories\Eloquent\TaskRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $bindings = [
        WorkspaceInterface::class =>WorkspaceRepository::class,
        TaskInterface::class => TaskRepository::class,
        UserInterface::class => Eloquent\UserRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
