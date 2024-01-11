<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface FileStorageServiceContract
{
    public function upload(UploadedFile $file, string $additionalPath = ''): string;

    public function remove(string $file): void;
}
