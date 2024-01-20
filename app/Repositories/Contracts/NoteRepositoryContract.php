<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface NoteRepositoryContract
{
    public function create(CreateNoteRequest $request): bool;

    public function update(UpdateNoteRequest $request, Note $note): bool;

    public function destroy(Note $note): bool;

    public function index(int $perPage, Request $request): LengthAwarePaginator;

    public function heads(int $perPage, Request $request): LengthAwarePaginator;

    public function getParent(Request $request): ?Note;

    public function detachChilds(Note $note): void;
}
