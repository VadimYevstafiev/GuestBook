<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\CreateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface NoteRepositoryContract
{
    public function create(CreateNoteRequest $request): bool;

    public function index(int $perPage, Request $request): LengthAwarePaginator;

    public function heads(int $perPage, Request $request): LengthAwarePaginator;

    public function getParent(Request $request): ?Note;
}
