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
        Note::factory(config('custom.notes.seeder.count_rows'))
        ->withParent()
        ->withImages()
        ->withTextFiles()
        ->create();
    }
}
