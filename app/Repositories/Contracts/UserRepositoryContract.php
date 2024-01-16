<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\Auth\RegisterRequest;

interface UserRepositoryContract
{
    public function store(RegisterRequest $request): bool;
}
