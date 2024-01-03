<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;
use App\Repositories\Contracts\NoteRepositoryContract;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function home(HomeRequest $request, NoteRepositoryContract $repository)
    {   
        $items = $repository->index(config('custom.notes.index.count_rows'), $request);

        return view('home', compact('items'));
    }

    public function heads(Request $request, NoteRepositoryContract $repository)
    {
        $heads = $repository->heads(config('custom.notes.index.count_rows'), $request);

        return view('heads', compact('heads'));
    }
}
