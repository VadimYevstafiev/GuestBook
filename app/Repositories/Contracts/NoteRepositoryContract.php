<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface NoteRepositoryContract
{
    public function index(int $perPage, Request $request): LengthAwarePaginator;
}
