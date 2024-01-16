<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = config('custom.notes.seeder.count_rows');
        Note::factory()->create();
        for ($i = 1; $i < $count; $i++) {
            Note::factory()->withParent(mt_rand(1, $i))->create();
        }
    }
}
