<?php

namespace App\View\Components;

use App\Models\Note;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoteBody extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Note $note) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.note-body');
    }
}
