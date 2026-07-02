<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    public function __construct(private ServiceService $serviceService) {}

    public function index(): JsonResponse
    {
        return response()->json(ServiceResource::collection($this->serviceService->list()));
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json(new ServiceResource($service));
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {
        $this->authorize('create', Service::class);

        $service = $this->serviceService->create($request->validated());

        return response()->json(new ServiceResource($service), Response::HTTP_CREATED);
    }

    public function update(UpdateServiceRequest $request, Service $service): JsonResponse
    {
        $this->authorize('update', $service);

        $service = $this->serviceService->update($service, $request->validated());

        return response()->json(new ServiceResource($service));
    }

    public function destroy(Service $service): JsonResponse
    {
        $this->authorize('delete', $service);

        $this->serviceService->delete($service);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
