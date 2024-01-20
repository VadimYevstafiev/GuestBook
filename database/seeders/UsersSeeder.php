<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;

class UsersSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = config('custom.users.seeder.count_rows');

        if (!User::where('email', 'admin@admin.com')->exists()) {
            $admin = User::factory()
                ->withEmail('admin@admin.com')
                ->withAvatar()
                ->create();
            $admin->syncRoles('admin');
            $count--;
        }

        if (!User::where('email', 'test@test.com')->exists()) {
            User::factory()
                ->withEmail('test@test.com')
                ->withAvatar()
                ->create();
            $count--;
        }

        User::factory($count)->withAvatar()->create();
    }
}
