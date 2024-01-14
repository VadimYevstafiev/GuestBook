<?php

namespace App\Observers;

use App\Models\Image;
use App\Services\Contracts\FileStorageServiceContract;

class ImageObserver
{
    public function __construct(public  FileStorageServiceContract $service) {}
    /**
     * Handle the Image "deleted" event.
     */
    public function deleted(Image $image): void
    {
        $this->service->remove($image->path);
    }
}
