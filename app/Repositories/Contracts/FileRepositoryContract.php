<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface FileRepositoryContract
{
    public function attach(Model $model, string $type, UploadedFile $file): void;

    public function deleteDirectories(string $type, int $id): void;
}
 