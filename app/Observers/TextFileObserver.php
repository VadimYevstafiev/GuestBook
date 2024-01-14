<?php

namespace App\Observers;

use App\Models\TextFile;
use App\Services\Contracts\FileStorageServiceContract;

class TextFileObserver
{
    public function __construct(public  FileStorageServiceContract $service) {}
    /**
     * Handle the TextFile "deleted" event.
     */
    public function deleted(TextFile $textFile): void
    {
        $this->service->remove($textFile->path);
    }
}
