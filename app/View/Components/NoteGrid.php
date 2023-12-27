<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoteGrid extends Component
{
    public int $id;
    public string $userName;
    public string $content;
    public int $marginLeft;
    /**
     * Create a new component instance.
     */
    public function __construct(array $note)
    {
        $this->id = $note['id'];
        $this->userName = $note['user_name'];
        $this->content = $note['content'];
        $this->marginLeft = $note['deep'] * config('custom.notes.index.left_step');

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.note-grid');
    }
}
