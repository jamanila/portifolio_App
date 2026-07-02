<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use App\Services\TestimonialService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimonialController extends Controller
{
    use HandlesUploads;

    public function __construct(private TestimonialService $testimonialService) {}

    public function index(Request $request): JsonResponse
    {
        $testimonials = $request->boolean('featured')
            ? $this->testimonialService->featured()
            : $this->testimonialService->list();

        return response()->json(TestimonialResource::collection($testimonials));
    }

    public function show(Testimonial $testimonial): JsonResponse
    {
        return response()->json(new TestimonialResource($testimonial));
    }

    public function store(StoreTestimonialRequest $request): JsonResponse
    {
        $this->authorize('create', Testimonial::class);

        $data = $request->validated();

        if ($request->hasFile('client_photo')) {
            $data['client_photo'] = $this->storeImage($request->file('client_photo'), 'testimonials');
        }

        $testimonial = $this->testimonialService->create($data);

        return response()->json(new TestimonialResource($testimonial), Response::HTTP_CREATED);
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): JsonResponse
    {
        $this->authorize('update', $testimonial);

        $data = $request->validated();

        if ($request->hasFile('client_photo')) {
            $this->deleteImage($testimonial->client_photo);
            $data['client_photo'] = $this->storeImage($request->file('client_photo'), 'testimonials');
        }

        $testimonial = $this->testimonialService->update($testimonial, $data);

        return response()->json(new TestimonialResource($testimonial));
    }

    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $this->authorize('delete', $testimonial);

        $this->deleteImage($testimonial->client_photo);
        $this->testimonialService->delete($testimonial);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
