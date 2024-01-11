<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\HomeRequest;
use App\Repositories\Contracts\NoteRepositoryContract;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function __construct(protected NoteRepositoryContract $repository) {}

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
}
