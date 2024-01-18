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
    public string $direction;
    public string $addedClasses;
    public bool $crashed;
    /**
     * Create a new component instance.
     */
    public function __construct(
        Note $note,
        string $direction,
        string $addedClasses,
        bool $crashed
    )
    {
        $this->crashed = $crashed;
        $this->direction = $direction;
        $this->addedClasses = $addedClasses;
        $this->files = collect();

        foreach (config("custom.notes.files") as $key => $relation) {
            $this->files = $this->files->concat(
                call_user_func([$note, $relation['relation']])
                ->get()
                ->map(function($item) use($key)  {
                    return [
                        'type' => str_replace('_', '-', $key) . '-box',
                        'url' => $item->url
                    ];
            }));
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
