<?php

namespace App\Repositories;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\User;
use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Contracts\NoteRepositoryContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NoteRepository implements NoteRepositoryContract
{
    public function create(CreateNoteRequest $request): bool
    {
        try {
            DB::beginTransaction();

            $data = collect($request->validated())
                ->put('author_id', auth()->user()->id);

            $note = Note::create($data->except(['files'])->toArray());
            $this->attachFiles($note, $data);

            DB::commit();
            return true;
        } catch(Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    public function update(UpdateNoteRequest $request, Note $note): bool
    {
        try {
            DB::beginTransaction();

            $data = collect($request->validated())
                ->put('author_id', auth()->user()->id);

            $note->update($data->except(['files'])->toArray());
            $this->attachFiles($note, $data);
             
            DB::commit();
            return true;
        } catch(Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }  
    }

    public function destroy(Note $note): bool
    {
        try {
            DB::beginTransaction();

            $id = $note->id;
            $type = $note->getTable();

            $this->detachChilds($note);
            $this->detachImages($note);

            $note->delete();            
            DB::commit();

            $service = app()->make(FileRepositoryContract::class);
            $service->deleteDirectories($type, $id);

            return true;
        } catch(Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }  
    }

    public function index(int $perPage, Request $request): LengthAwarePaginator
    {
        $notes = Note::whereNull('parent_id')
            ->with('author.avatar', 'childs')
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

    public function heads(int $perPage, Request $request): LengthAwarePaginator
    {
        $param = array_filter($request->all(), function($key) {
            return $key !== 'page';
        }, ARRAY_FILTER_USE_KEY);

        $param = (!empty($param))
            ? $param
            : ['user_name' => 'asc'];

        $column = array_key_first($param);
        $order = array_shift($param);

        $column = ($column === 'created_at')
            ? $column
            : User::select($column)
                ->whereColumn('author_id', 'users.id')
                ->orderBy($column, $order)
                ->limit(1);

        return Note::whereNull('parent_id')
            ->with('author')
            ->orderBy($column, $order)
            ->paginate($perPage)->withQueryString();
    }

    public function getParent(Request $request): ?Note
    {
        $params = $request->all();
        
        return isset($params['parent'])
            ? Note::where('id', $params['parent'])
                ->with('author:id,email,user_name')
                ->first()                
            : null;
    }

    public function getNote(string $id): Note
    {
        return Note::where('id', $id)
            ->with('author:id,email,user_name', 
                'parent.author:id,email,user_name',
                'images',
                'text_files')
            ->first();
    }

    protected function getChilds(Note $note, int $deep): array
    {
        $result = [[
            'note' => $note, 
            'deep' => $deep
        ]];
        if (count($note->childs)) {
            $deep++;
            foreach ($note->childs as $note) {
                $result = array_merge($result, $this->getChilds($note, $deep));
            }
        }
        return $result;
    }

    protected function attachFiles(Note $note, Collection $data): void
    {
        if (!is_null($data->get('files'))) {
            foreach ($data->get('files') as $file) {
                $type = explode('/', $file->getClientMimeType());
                $type = array_shift($type);

                $fileRepository = app()->make('fileRepository-selector-' . $type);
                $fileRepository->attach($note, $type, $file);
            }
        }
    }

    protected function detachChilds(Note $note): void
    {
        if ($note->childs()->exists()) {
            $newParentId = null;
            if ($note->parent()->exists()) {
                $newParentId = $note->parent()->first()->id;
            }
            $note->childs()->update(['parent_id' => $newParentId]);
        }
    }

    protected function detachImages(Note $note): void
    {
        if ($note->images->count() > 0) {
            $note->images->each->delete();
        }
    }

    protected function detachTextFies(Note $note): void
    {
        if ($note->text_files->count() > 0) {
            $note->text_files->each->delete();
        }
    }
}
