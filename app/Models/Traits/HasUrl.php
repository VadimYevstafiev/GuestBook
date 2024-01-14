<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

trait HasUrl
{
    public function url(): Attribute
    {
        return Attribute::make(
            get: function() {
                if (!Storage::exists($this->attributes['path'])) {
                    return $this->attributes['path'];
                }

                return Storage::url(($this->attributes['path']));
            }
        );
    }
}

