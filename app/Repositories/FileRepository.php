<?php

namespace App\Repositories;

use App\Repositories\Contracts\FileRepositoryContract;
use App\Services\Contracts\FileStorageServiceContract;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class FileRepository implements FileRepositoryContract
{
    public function __construct(protected FileStorageServiceContract $service) {}

    public function attach(Model $model, string $relation, UploadedFile $file, ?string $path = null): void
    {        
        if (!method_exists($model, $relation)) 
            throw new Exception($model::class . "does not have a {$relation} relation");

        call_user_func([$model, $relation])
            ->create(['path' => $this->service->upload($file, $path)]);
    }
}
