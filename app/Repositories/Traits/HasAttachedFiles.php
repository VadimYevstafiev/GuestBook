<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

trait HasAttachedFiles
{
    public function attachFile(?UploadedFile $file, Model $model): void
    {
        if (!is_null($file)) {
            $type = explode('/', $file->getClientMimeType());
            $type = array_shift($type);
    
            $fileRepository = app()->make('fileRepository-selector-' . $type);
            $fileRepository->attach($model, $type, $file);
        }
    }

    public function attachFiles(?array $files, Model $model): void
    {
        if (!is_null($files)) array_map(
            array($this, 'attachFile'),
            $files,
            array_fill(0, count($files), $model)
        );
    }

    public function detachFiles(Model $model): void
    {   
        $table = $model->getTable();
        foreach (config("custom.{$table}.files") as $item) {
            $files = call_user_func([$model, $item['relation']])->get();
            if ($files->count() > 0) {
                $files->each->delete();
            }
        }
    }
}
