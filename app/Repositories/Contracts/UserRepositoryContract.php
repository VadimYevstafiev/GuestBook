<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

interface UserRepositoryContract
{
    public function store(RegisterRequest $request): bool;

    public function destroy(User $user):bool;
}
