<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class NoteInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ViewErrorBag $errors,
        public ?string $content = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.note-input');
    }
}
