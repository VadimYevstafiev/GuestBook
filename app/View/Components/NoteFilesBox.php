<?php

namespace App\View\Components;

use App\Models\Note;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class NoteFilesBox extends Component
{
    public Collection $files;
    /**
     * Create a new component instance.
     */
    public function __construct(Note $note)
    {
        $this->files = collect([]);
        foreach (config("custom.notes.files") as $relation) {
            $this->files = $this->files->merge(call_user_func([$note, $relation['relation']])->get());
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.note-files-box');
    }
}
