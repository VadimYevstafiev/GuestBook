<?php

namespace App\Repositories;

use App\Repositories\Contracts\FileRepositoryContract;
use App\Services\Contracts\FileStorageServiceContract;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileRepository implements FileRepositoryContract
{
    public function __construct(protected FileStorageServiceContract $service) {}

    public function attach(Model $model, string $type, UploadedFile $file): void
    {
        $table = $model->getTable();
        $path = "{$table}/" . config("custom.{$table}.files.{$type}.dir") . "/{$model->id}";
        $relation = config("custom.{$table}.files.{$type}.relation");

        if (!method_exists($model, $relation)) 
            throw new Exception($model::class . "does not have a {$relation} relation");

        call_user_func([$model, $relation])
            ->create([
                'name' => $file->getClientOriginalName(),
                'path' => $this->service->upload($file, $path)
            ]);
    }

    public function deleteDirectories(string $type, int $id): void
    {
        foreach (config("custom.{$type}.files") as $item) {
            $directory = "public/{$type}/{$item['dir']}/{$id}";
            if (in_array($directory, Storage::directories('public', true))) {
                Storage::deleteDirectory($directory);
            }
        }
    }
}
