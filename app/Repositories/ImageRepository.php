<?php

namespace App\Repositories;

use App\Repositories\Contracts\ImageRepositoryContract;
use App\Services\Contracts\FileStorageServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ImageRepository extends FileRepository implements ImageRepositoryContract
{
    public int $height;
    public int $width;

    public function setImageSize(int $height, int $width): void
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function attach(Model $model, string $relation, UploadedFile $file, ?string $path = null): void
    {
        $tmp = $file->getRealPath();
            
        \Tinify\setKey(config('custom.tinify.key'));

        $source = \Tinify\fromFile($tmp);
        $resized = $source->resize(array(
            "method" => "fit",
            "width" => $this->width,
            "height" => $this->height
        ));
        unlink($tmp);
        $resized->toFile($tmp);
        
        parent::attach($model, $relation, $file, $path);
    }
}
