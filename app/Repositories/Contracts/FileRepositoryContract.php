<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface FileRepositoryContract
{
    public function attach(Model $model, string $relation, UploadedFile $file, ?string $path = null): void;
}
 