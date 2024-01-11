<?php

namespace App\Repositories\Contracts;

interface ImageRepositoryContract
{
    public function setImageSize(int $height, int $width): void;
}
