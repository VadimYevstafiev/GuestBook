<?php

namespace App\Services;

use App\Services\Contracts\FileStorageServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService implements FileStorageServiceContract
{
    public function upload(UploadedFile $file, string $additionalPath = ''): string
    {
        $additionalPath = !empty($additionalPath) ? "{$additionalPath}/" : '';

        $filePath = "public/{$additionalPath}" . Str::random() . '_' . time() . '.' . $file->getClientOriginalExtension();

        Storage::put($filePath, $this->getContent($file));
        Storage::setVisibility($filePath, 'public');

        return $filePath;
    }

    public function remove(string $file): void
    {
        Storage::delete($file);
    }

    protected function getContent(UploadedFile $file): string
    {
        return File::get($file);
    }
}
