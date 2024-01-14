<?php

namespace App\Repositories;

use App\Repositories\Contracts\FileRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ImageRepository extends FileRepository implements FileRepositoryContract
{

    public function attach(Model $model, string $type, UploadedFile $file): void
    {
        $table = $model->getTable();
        
        $tmp = $file->getRealPath();
            
        \Tinify\setKey(config('custom.tinify.key'));

        $source = \Tinify\fromFile($tmp);
        $resized = $source->resize(array(
            "method" => "fit",
            "width" => config("custom.{$table}.files.{$type}.file.size.width"),
            "height" => config("custom.{$table}.files.{$type}.file.size.height")
        ));
        unlink($tmp);
        $resized->toFile($tmp);
        
        parent::attach($model, $type, $file);
    }
}
