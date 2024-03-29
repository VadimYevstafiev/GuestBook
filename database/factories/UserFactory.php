<?php

namespace Database\Factories;

use App\Fakers\Contracts\ImageFakerContract;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    use HasRoles;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'home_page' => fake()->url(),
            'password' => Hash::make('test1234'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withEmail(string $email) 
    {
        return $this->state(function (array $attributes) use ($email) {
            return [
                'email' => $email
            ];
        });
    }

    public function withAvatar(): Factory
    {
        return $this->state(function(array $attributes) {
            return $attributes;
        })->afterCreating(function(User $user) {
            $faker = app()->make(ImageFakerContract::class);
            $img = config('custom.users.seeder.fake_images_id')[$user->id - 1];
            $file =$faker->id($img)->image();
            Image::factory()->setData($user, $file);
        });
    }

    public function configure()
    {
        return $this->afterCreating(function(User $user) {
            $user->assignRole('user');
        });
    }
}
