<?php

namespace App\Providers;

use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Contracts\NoteRepositoryContract;
use App\Repositories\FileRepository;
use App\Repositories\ImageRepository;
use App\Repositories\NoteRepository;
use App\Services\Contracts\FileStorageServiceContract;
use App\Services\FileStorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        NoteRepositoryContract::class => NoteRepository::class,
        FileStorageServiceContract::class => FileStorageService::class,
        FileRepositoryContract::class => FileRepository::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('fileRepository-selector-image', function() {
            return new ImageRepository($this->app->make(FileStorageServiceContract::class));
        });

        $this->app->bind('fileRepository-selector-text', function() {
            return new FileRepository($this->app->make(FileStorageServiceContract::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
