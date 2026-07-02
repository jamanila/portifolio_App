<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Requests\StoreUploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    use HandlesUploads;

    public function store(StoreUploadRequest $request): JsonResponse
    {
        $directory = $request->input('directory', 'misc');
        $path = $this->storeImage($request->file('file'), $directory);

        return response()->json([
            'path' => $path,
            'url' => Storage::disk('public')->url($path),
        ], Response::HTTP_CREATED);
    }
}
