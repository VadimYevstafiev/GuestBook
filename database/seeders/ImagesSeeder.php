<?php

namespace Database\Seeders;

use App\Fakers\Contracts\ImageFakerContract;
use App\Models\Image;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app()->make(ImageFakerContract::class);

        $avatars = config('custom.users.seeder.fake_images_id');
        foreach (User::all() as $key => $user) {
            $file = $faker->id($avatars[$key])->image();
            Image::factory()->setData($user, $file);
        }

        foreach (Note::all() as $note){
            $count = mt_rand(0, 3);
            for ($i = 0; $i < $count; $i++) {
                $file = $faker->image();
                Image::factory()->setData($note, $file);
            }
        }
    }
}
