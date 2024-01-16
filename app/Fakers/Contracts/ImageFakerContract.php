<?php

namespace App\Fakers\Contracts;

use Illuminate\Http\UploadedFile;

interface ImageFakerContract
{
    public function imageUrl(): string;

    public function image(): UploadedFile;

    public function width(int $size): self;

    public function height(int $size): self;

    public function extension(string $extension): self;
}
