<?php

namespace App\Repositories;

use App\Repositories\Contracts\FileRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ImageRepository extends FileRepository implements FileRepositoryContract
{

    public function attach(Model $model, string $type, UploadedFile $file): void
    {
        // $table = $model->getTable();
        
        // $tmp = $file->getRealPath();

        // list($width, $height) = getimagesize($tmp);

        // $config = config("custom.{$table}.files.{$type}.file.size");


        // $config['width'] = $width > $config['width']
        //     ? $config['width']
        //     : $width;
        
        // $config['height'] = $height > $config['height']
        //     ? $config['height']
        //     : $height;
        
        // $config['method'] = 'fit';

        // \Tinify\setKey(config('custom.tinify.key'));

        // $source = \Tinify\fromFile($tmp);
        // $resized = $source->resize($config);
        // unlink($tmp);
        // $resized->toFile($tmp);
        
        parent::attach($model, $type, $file);
    }
}
