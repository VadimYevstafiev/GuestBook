<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Note;
use App\Models\TextFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => User::all()->random()->id,
            'parent_id' => null,
            'content' => fake()->realText(800)
        ];
    }

    public function withParent(): Factory
    {
        return $this->state(function(array $attributes) {
            return $attributes;
        })->afterCreating(function(Note &$note) {
            $parent_id = ($note->id === 1) 
                ? null
                : ((mt_rand(0,2)) ? mt_rand(1, ($note->id - 1)) : null);
            $note->update(['parent_id' => $parent_id]);
        });
    }

    public function withImages(): Factory
    {
        return $this->state(function(array $attributes) {
            return $attributes;
        })->afterCreating(function(Note $note) {
            $count = mt_rand(0, 3);
            for ($i = 0; $i < $count; $i++) {
                Image::factory()->setData($note);
            }
        });
    }

    public function withTextFiles(): Factory
    {
        return $this->state(function(array $attributes) {
            return $attributes;
        })->afterCreating(function(Note $note) {
            $count = mt_rand(0, 2);
            for ($i = 0; $i < $count; $i++) {
                TextFile::factory()->setData($note);
            }
        });
    }
}
