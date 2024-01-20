<?php

namespace App\Observers;

use App\Models\Note;
use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Contracts\NoteRepositoryContract;

class NoteObserver
{
    public function __construct(public NoteRepositoryContract $repository) {}
    /**
     * Handle the Note "deleted" event.
     */
    public function deleted(Note $note): void
    {
        $id = $note->id;
        $type = $note->getTable();

        $this->repository->detachChilds($note);
        $this->repository->detachFiles($note);

        $service = app()->make(FileRepositoryContract::class);
        $service->deleteDirectories($type, $id);
    }
}
