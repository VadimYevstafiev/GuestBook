<?php

namespace App\View\Components;

use App\Models\TextFile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public TextFile $model,
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
