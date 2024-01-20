<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class TextBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $url,
        public string $model,
        public string $addedClasses,
        public bool $crashed = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-box');
    }
}
