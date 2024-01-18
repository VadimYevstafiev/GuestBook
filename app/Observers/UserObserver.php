<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\Contracts\FileRepositoryContract;

class UserObserver
{
    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $id = $user->id;
        $type = $user->getTable();

        $service = app()->make(FileRepositoryContract::class);
        $service->deleteDirectories($type, $id);
    }
}
