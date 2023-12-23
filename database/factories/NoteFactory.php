<?php

namespace Database\Factories;

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
            'content' => fake()->paragraphs(rand(2, 5), true)
        ];
    }

    public function withParent(int $parent_id): Factory
    {
        return $this->state(function(array $attributes) use ($parent_id) {
            return [
               'parent_id' => (mt_rand(0,2)) ? $parent_id : null
            ];
        });
    }
}
