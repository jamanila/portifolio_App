<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Resources\TechnologyResource;
use App\Models\Technology;
use App\Services\TechnologyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TechnologyController extends Controller
{
    public function __construct(private TechnologyService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(TechnologyResource::collection($this->service->list()));
    }

    public function show(Technology $technology): JsonResponse
    {
        return response()->json(new TechnologyResource($technology));
    }

    public function store(StoreTechnologyRequest $request): JsonResponse
    {
        $this->authorize('create', Technology::class);

        $technology = $this->service->create($request->validated());

        return response()->json(new TechnologyResource($technology), Response::HTTP_CREATED);
    }

    public function update(UpdateTechnologyRequest $request, Technology $technology): JsonResponse
    {
        $this->authorize('update', $technology);

        $technology = $this->service->update($technology, $request->validated());

        return response()->json(new TechnologyResource($technology));
    }

    public function destroy(Technology $technology): JsonResponse
    {
        $this->authorize('delete', $technology);

        $this->service->delete($technology);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
