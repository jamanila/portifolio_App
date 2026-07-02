<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSocialLinkRequest;
use App\Http\Requests\UpdateSocialLinkRequest;
use App\Http\Resources\SocialLinkResource;
use App\Models\SocialLink;
use App\Services\SocialLinkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialLinkController extends Controller
{
    public function __construct(private SocialLinkService $socialLinkService) {}

    public function index(Request $request): JsonResponse
    {
        $links = $request->user('sanctum')
            ? $this->socialLinkService->list()
            : $this->socialLinkService->active();

        return response()->json(SocialLinkResource::collection($links));
    }

    public function store(StoreSocialLinkRequest $request): JsonResponse
    {
        $this->authorize('create', SocialLink::class);

        $socialLink = $this->socialLinkService->create($request->validated());

        return response()->json(new SocialLinkResource($socialLink), Response::HTTP_CREATED);
    }

    public function update(UpdateSocialLinkRequest $request, SocialLink $socialLink): JsonResponse
    {
        $this->authorize('update', $socialLink);

        $socialLink = $this->socialLinkService->update($socialLink, $request->validated());

        return response()->json(new SocialLinkResource($socialLink));
    }

    public function destroy(SocialLink $socialLink): JsonResponse
    {
        $this->authorize('delete', $socialLink);

        $this->socialLinkService->delete($socialLink);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
