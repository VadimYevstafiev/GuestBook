<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ImageStorageService extends FileStorageService
{
    public function __construct(
        protected int $width,
        protected int $height
    ) {}

    protected function getContent(UploadedFile $file): array
    {
        $path = $file->getRealPath();
        $extension = $file->getClientOriginalExtension();

        \Tinify\setKey(config('custom.utinify.key'));

        $source = \Tinify\fromFile($path);
        $resized = $source->resize(array(
            "method" => "fit",
            "width" => $this->width,
            "height" => $this->height
        ));
        unlink($path);
        $resized->toFile($path);

        return array(File::get($path), $extension);
    }
}
