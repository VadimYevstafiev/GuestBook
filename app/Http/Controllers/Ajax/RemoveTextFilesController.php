<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\TextFile;
use Exception;

class RemoveTextFilesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TextFile $file)
    {
        try {
            $file->delete();
            return response()->json(['message' => 'File was removed']);
        } catch (Exception $exception) {
            return response(status: 422)->json(['message' => $exception->getMessage()]);
        }
    }
}
