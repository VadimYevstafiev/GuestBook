<?php

namespace App\Fakers;

use App\Fakers\Contracts\ImageFakerContract;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class PicsumImageFaker implements ImageFakerContract
{
    protected string $domain = 'https://picsum.photos';
    protected ?int $id;
    protected ?int $width;
    protected ?int $height;
    protected array $options;
    protected ?string $extension;

    public function __construct()
    {
        $this->reset();
    }

    public function imageUrl(): string
    {
        $result = clone $this;
        $this->reset();
        return $result->getUrl();
    }

    public function image(): UploadedFile
    {
        $result = clone $this;
        $this->reset();
        return $result->getImage();
    }

    public function id(int $id): ImageFakerContract
    {
        $this->id = $id;
        return $this;
    }

    public function width(int $size): ImageFakerContract
    {
        $this->width = $size;
        return $this;
    }

    public function height(int $size): ImageFakerContract
    {
        $this->height = $size;
        return $this;
    }

    public function grayscale(): ImageFakerContract
    {
        $this->options['grayscale'] = 'grayscale';
        return $this;
    }

    public function blur(?int $scale = null): ImageFakerContract
    {
        $this->options['blur'] = 'blur';
        if (!is_null($scale) && (0 < $scale) && ($scale < 11)) $this->options['blur'] .= "={$scale}";
        return $this;
    }

    public function extension(string $extension = null): ImageFakerContract
    {
        $extension === 'webp'
            ? $this->extension = '.webp'
            : $this->extension = '.jpg';
        return $this;
    }

    protected function reset(): void
    {
        $this->id = null;
        $this->width = null;
        $this->height = null;
        $this->options = [];
        $this->extension = null;
    }

    protected function getUrl(): string
    {
        $result = $this->domain;

        if (!is_null($this->id)) $result .= "/id/{$this->id}";

        if (is_null($this->width) && is_null($this->height)) {
            $result .= "/800/600";
        } else{
            if (!is_null($this->width)) $result .= "/{$this->width}";
            if (!is_null($this->height)) $result .= "/{$this->height}";
        }

        if (!empty($this->options)) {
            $result .= "?";
            $result .= implode('&', $this->options);
        }

        if (!is_null($this->extension)) $result .= "{$this->extension}";
        return $result;
    }

    public function getImage(): UploadedFile
    {
        $tmp = stream_get_meta_data(tmpfile())['uri'];
        file_put_contents($tmp, file_get_contents($this->getUrl()));
        $file = new File($tmp);
        return new UploadedFile(
            $file->getPathname(),
            $file->getFilename(),
            $file->getMimeType(),
        );
    }
}
