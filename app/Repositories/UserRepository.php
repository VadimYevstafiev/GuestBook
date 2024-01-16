<?php

namespace App\Repositories;

use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryContract
{
    public function store(RegisterRequest $request): bool
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();
            $fields['password'] = Hash::make($fields['password']);
            $avatar = $fields['avatar'];
            unset($fields['avatar']);

            $user = User::create($fields);
            $type = explode('/', $avatar->getClientMimeType());
            $type = array_shift($type);
            $fileRepository = app()->make('fileRepository-selector-' . $type);
            $fileRepository->attach($user, $type, $avatar);

            DB::commit();

            event(new Registered($user));

            Auth::login($user);
            return true;
        } catch(Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }
}
