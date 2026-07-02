<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use App\Services\ContactMessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactMessageController extends Controller
{
    public function __construct(private ContactMessageService $contactMessageService) {}

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', ContactMessage::class);

        $messages = $request->boolean('unread')
            ? $this->contactMessageService->unread()
            : $this->contactMessageService->list();

        return response()->json(ContactMessageResource::collection($messages));
    }

    public function show(ContactMessage $contactMessage): JsonResponse
    {
        $this->authorize('view', $contactMessage);

        return response()->json(new ContactMessageResource($contactMessage));
    }

    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $message = $this->contactMessageService->submit($request->validated());

        return response()->json(new ContactMessageResource($message), Response::HTTP_CREATED);
    }

    public function update(ContactMessage $contactMessage): JsonResponse
    {
        $this->authorize('update', $contactMessage);

        $message = $this->contactMessageService->markAsRead($contactMessage);

        return response()->json(new ContactMessageResource($message));
    }

    public function destroy(ContactMessage $contactMessage): JsonResponse
    {
        $this->authorize('delete', $contactMessage);

        $this->contactMessageService->delete($contactMessage);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
