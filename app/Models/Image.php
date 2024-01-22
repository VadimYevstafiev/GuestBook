<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'imageable_id',
        'imageable_type'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function() {
                // if (!Storage::exists($this->attributes['path'])) {
                //     return $this->attributes['path'];
                // }
                // return Storage::url($this->attributes['path']);

                
                if(!Cache::has($this->attributes['path'])) {
                    $link = Storage::temporaryUrl($this->attributes['path'], now()->addMinutes(10));
                    Cache::put($this->attributes['path'], $link, 570);
                    return $link;
                }

                return Cache::get($this->attributes['path']);
            }
        );
    }
}
