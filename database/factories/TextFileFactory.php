<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextFile>
 */
class TextFileFactory extends Factory
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
            'note_id' => null,
        ];
    }

    public function setData(Note $note)
    {
        $tmp = stream_get_meta_data(tmpfile())['uri'];
        file_put_contents($tmp, fake()->realText(800));
        $file = new File($tmp);

        $file = new UploadedFile(
            $file->getPathname(),
            ($file->getFilename() . '.txt'),
            $file->getMimeType(),
        );

        $type = explode('/', $file->getClientMimeType());
        $type = array_shift($type);

        $fileRepository = app()->make('fileRepository-selector-' . $type);
        $fileRepository->attach($note, $type, $file);
    }
}
