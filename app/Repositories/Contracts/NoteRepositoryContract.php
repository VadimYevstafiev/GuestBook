<?php

namespace App\Repositories\Contracts;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface NoteRepositoryContract
{
    public function index(int $perPage, Request $request): LengthAwarePaginator;

    public function heads(int $perPage, Request $request): LengthAwarePaginator;

    public function getParent(Request $request): ?Note;
}
