<?php

namespace App\Providers;

use App\Repositories\Contracts\NoteRepositoryContract;
use App\Repositories\NoteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        NoteRepositoryContract::class => NoteRepository::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
