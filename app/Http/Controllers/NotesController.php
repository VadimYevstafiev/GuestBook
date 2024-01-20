<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\HomeRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Repositories\Contracts\NoteRepositoryContract;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function __construct(protected NoteRepositoryContract $repository)
    {
        $this->authorizeResource(Note::class, 'note');
    }

    public function home(HomeRequest $request)
    {   
        $items = $this->repository->index(config('custom.notes.index.count_rows'), $request);

        return view('home', compact('items'));
    }

    public function heads(Request $request)
    {
        $heads = $this->repository->heads(config('custom.notes.index.count_rows'), $request);

        return view('heads', compact('heads'));
    }

    public function create(Request $request)
    {
        $parent = $this->repository->getParent($request);

        return view('create', compact('parent'));
    }

    public function store(CreateNoteRequest $request)
    {   
        return $this->repository->create($request)
            ? redirect()->route('home')
            : redirect()->back()->withInput();
    }

    public function edit(Note $note)
    {
        return view('edit', compact('note'));
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        return $this->repository->update($request, $note)
        ? redirect()->route('home')
        : redirect()->back()->withInput();
    }

    public function destroy(Note $note)
    {
        return $this->repository->destroy($note)
            ? redirect()->back()
            : abort(403);
    }
}
