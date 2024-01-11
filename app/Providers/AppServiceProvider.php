<?php

namespace App\Providers;

use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\NoteRepositoryContract;
use App\Repositories\FileRepository;
use App\Repositories\ImageRepository;
use App\Repositories\NoteRepository;
use App\Services\Contracts\FileStorageServiceContract;
use App\Services\FileStorageService;
//use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        NoteRepositoryContract::class => NoteRepository::class,
        FileStorageServiceContract::class => FileStorageService::class,
        FileRepositoryContract::class => FileRepository::class,
        ImageRepositoryContract::class => ImageRepository::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(FileRepositoryContract::class, function(Application $app, $param) {
        //     return match ($param['type']) {
        //         'image' => new ImageRepository($this->app->make(FileStorageServiceContract::class)),
        //         'text' => new FileRepository($this->app->make(FileStorageServiceContract::class)),
        //     };
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
