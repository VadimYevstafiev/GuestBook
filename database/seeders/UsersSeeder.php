<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = config('custom.users.seeder.count_rows');
        if (!User::where('email', 'test@test.com')->exists()) {
            User::factory()
                ->withEmail('test@test.com')
                ->create();
            $count--;
        }
        User::factory($count)->create();
    }
}
