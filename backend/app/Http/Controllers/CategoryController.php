<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(CategoryResource::collection($this->service->list()));
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json(new CategoryResource($category));
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $this->authorize('create', Category::class);

        $category = $this->service->create($request->validated());

        return response()->json(new CategoryResource($category), Response::HTTP_CREATED);
    }

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $this->authorize('update', $category);

        $category = $this->service->update($category, $request->validated());

        return response()->json(new CategoryResource($category));
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->authorize('delete', $category);

        $this->service->delete($category);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
