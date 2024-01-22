<?php

namespace App\Providers;

use App\Fakers\Contracts\ImageFakerContract;
use App\Fakers\PicsumImageFaker;
use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Contracts\NoteRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\FileRepository;
use App\Repositories\ImageRepository;
use App\Repositories\NoteRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\FileStorageServiceContract;
use App\Services\FileStorageService;
use App\Services\TextFileStorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        NoteRepositoryContract::class => NoteRepository::class,
        FileRepositoryContract::class => FileRepository::class,
        UserRepositoryContract::class => UserRepository::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(!$this->app->environment('production')) {
            $this->app->register(FakerServiceProvider::class);
            $this->app->bind(ImageFakerContract::class, PicsumImageFaker::class);
        }

        $this->app->bind('fileRepository-selector-image', function() {
            return new ImageRepository(new FileStorageService());
        });

        $this->app->bind('fileRepository-selector-text', function() {
            return new FileRepository(new TextFileStorageService());
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
