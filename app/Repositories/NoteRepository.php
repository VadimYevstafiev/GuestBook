<?php

namespace App\Repositories;

use App\Models\Note;
use App\Repositories\Contracts\NoteRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class NoteRepository implements NoteRepositoryContract
{
    public function index(int $perPage, Request $request): LengthAwarePaginator
    {
        $notes = Note::whereNull('parent_id')
            ->with('author', 'childs')
            ->get();
        
        $result = [];
        foreach ($notes as $note) {
            $result = array_merge($result, $this->getChilds($note, 0));
        }

        $page = Paginator::resolveCurrentPage() ?: 1;

        $items = Collection::make($result);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );
    }

    protected function getChilds(Note $note, int $deep)
    {
        $result = [[
            'id' => $note->id,
            'user_name' => $note->author->user_name,
            'content' =>$note->content,
            'deep' =>$deep
        ]];
        if (count($note->childs)) {
            $deep++;
            foreach ($note->childs as $note) {
                $result = array_merge($result, $this->getChilds($note, $deep));
            }
        }
        return $result;
    }
}
