<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Contracts\NoteRepositoryContract;

class UserObserver
{
    public function __construct(public NoteRepositoryContract $repository) {}
    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $id = $user->id;
        $type = $user->getTable();

        $this->repository->detachFiles($user);

        $service = app()->make(FileRepositoryContract::class);
        $service->deleteDirectories($type, $id);
    }
}
