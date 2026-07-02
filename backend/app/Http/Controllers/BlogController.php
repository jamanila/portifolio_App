<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    use HandlesUploads;

    public function __construct(private BlogService $blogService) {}

    public function index(Request $request): JsonResponse
    {
        $blogs = $request->user('sanctum')
            ? $this->blogService->list()
            : $this->blogService->published();

        return response()->json(BlogResource::collection($blogs->load('category')));
    }

    public function show(Blog $blog): JsonResponse
    {
        return response()->json(new BlogResource($blog->load('category')));
    }

    public function store(StoreBlogRequest $request): JsonResponse
    {
        $this->authorize('create', Blog::class);

        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'blogs');
        }

        $blog = $this->blogService->create($data);

        return response()->json(new BlogResource($blog), Response::HTTP_CREATED);
    }

    public function update(UpdateBlogRequest $request, Blog $blog): JsonResponse
    {
        $this->authorize('update', $blog);

        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $this->deleteImage($blog->thumbnail);
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'blogs');
        }

        $blog = $this->blogService->update($blog, $data);

        return response()->json(new BlogResource($blog));
    }

    public function destroy(Blog $blog): JsonResponse
    {
        $this->authorize('delete', $blog);

        $this->deleteImage($blog->thumbnail);
        $this->blogService->delete($blog);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
