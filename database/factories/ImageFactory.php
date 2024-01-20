<?php

namespace Database\Factories;

use App\Fakers\Contracts\ImageFakerContract;
use App\Repositories\Traits\HasAttachedFiles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    use HasAttachedFiles;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => null,
            'imageable_id' => null,
            'imageable_type' => null,
        ];
    }

    public function setData(Model $model, UploadedFile $file = null)
    {
        if (is_null($file)) {
            $faker = app()->make(ImageFakerContract::class);
            $file = $faker->image();
        }
        $this->attachFile($file, $model);
    }

}
