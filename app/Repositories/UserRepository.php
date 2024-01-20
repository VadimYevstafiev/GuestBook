<?php

namespace App\Repositories;

use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Models\User;
use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Traits\HasAttachedFiles;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class UserRepository implements UserRepositoryContract
{
    use HasRoles, HasAttachedFiles;

    public function store(RegisterRequest $request): bool
    {

        try {
            DB::beginTransaction();

            $fields = collect($request->validated());
            $fields['password'] = Hash::make($fields['password']);

            $user = User::create($fields->except(['files'])->toArray());
            $user->assignRole('user');
            $this->attachFile($fields['avatar'], $user);

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
    
    public function destroy(User $user): bool
    {
        try {
            DB::beginTransaction();

            $id = $user->id;
            $type = $user->getTable();

            $this->detachFiles($user);
            $user->delete();

            DB::commit();

            $service = app()->make(FileRepositoryContract::class);
            $service->deleteDirectories($type, $id);

            return true;
        } catch(Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }  
    }
}
