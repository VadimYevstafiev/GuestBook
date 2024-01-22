<?php

namespace App\Services;

use App\Services\Contracts\FileStorageServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class TextFileStorageService extends FileStorageService implements FileStorageServiceContract
{
    protected function getContent(UploadedFile $file): string
    {
        return mb_convert_encoding(File::get($file), 'UTF-8');
    }
}
