<?php

namespace Database\Factories;

use App\Fakers\Contracts\ImageFakerContract;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
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
            $file =$faker->image();
        }

        $type = explode('/', $file->getClientMimeType());
        $type = array_shift($type);

        $fileRepository = app()->make('fileRepository-selector-' . $type);
        $fileRepository->attach($model, $type, $file);
    }

}
