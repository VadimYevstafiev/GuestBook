<?php

namespace App\Repositories;

use App\Http\Requests\CreateNoteRequest;
use App\Models\Note;
use App\Models\User;
use App\Repositories\Contracts\FileRepositoryContract;
use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\NoteRepositoryContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class NoteRepository implements NoteRepositoryContract
{
    public function create(CreateNoteRequest $request): bool
    {

        try {
            DB::beginTransaction();

            $data = collect($request->validated())->put('author_id', auth()->user()->id);
            $note = Note::create($data->except(['g-recaptcha-response', 'files'])->toArray());

            if (!is_null($data->get('files'))) {
                foreach ($data->get('files') as $file) {
                    $type = explode('/', $file->getClientMimeType());
                    $type = array_shift($type);

                    if ($type === 'image') {
                        $fileRepository = App::make(ImageRepositoryContract::class);
                        $fileRepository->setImageSize(
                            config('custom.notes.images.file.size.height'),
                            config('custom.notes.images.file.size.width'),
                        );
                        $relation = 'images';
                        $path = config('custom.notes.images.dir') . '/' . $note->id;
                    } else {
                        $fileRepository = App::make(FileRepositoryContract::class);
                        $relation = 'textFiles';
                        $path = config('custom.notes.text-files.dir') . '/' . $note->id;
                    }

                    $fileRepository->attach($note, $relation, $file, $path);
                }
            }
             
            DB::commit();
            return true;
        } catch(Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

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
            ? Note::where('id', $params['parent'])->with('author')->first()
            : null;
    }

    protected function getChilds(Note $note, int $deep)
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
}
