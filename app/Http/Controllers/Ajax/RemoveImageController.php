<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Exception;

class RemoveImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Image $image)
    {
        try {
            $image->delete();
            return response()->json(['message' => 'File was removed']);
        } catch (Exception $exception) {
            return response(status: 422)->json(['message' => $exception->getMessage()]);
        }
    }
}
