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
        list($content, $extension) = $this->getContent($file);

        $additionalPath = !empty($additionalPath) ? "{$additionalPath}/" : '';

        $filePath = "public/{$additionalPath}" . Str::random() . '_' . time() . '.' . $extension;

        //local disk
        Storage::put($filePath, $content);

        //AWS
        // Storage::disk('s3')->put($filePath, $content);
        // Storage::setVisibility($filePath, 'public');

        return $filePath;
    }

    public function remove(string $file): void
    {
        //local disk
        Storage::delete($file);

        //AWS
        // Storage::disk('s3')->delete($file);
    }

    protected function getContent(UploadedFile $file): array
    {
        return array(File::get($file), $file->getClientOriginalExtension());
    }
}
