<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    use HandlesUploads;

    public function __construct(private ProjectService $service) {}

    public function index(Request $request): JsonResponse
    {
        if ($request->boolean('featured')) {
            $projects = $this->service->featured();
        } else {
            $projects = $this->service->filter(
                $request->only(['category', 'technology', 'search', 'sort']),
                onlyPublished: ! $request->user('sanctum')
            );
        }

        return response()->json(ProjectResource::collection($projects));
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json(new ProjectResource($project->load(['category', 'technologies', 'images'])));
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $this->authorize('create', Project::class);

        $data = $request->validated();
        $data = $this->processUploads($request, $data);

        $project = $this->service->create($data);

        return response()->json(new ProjectResource($project), Response::HTTP_CREATED);
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $data = $request->validated();
        $data = $this->processUploads($request, $data);

        $project = $this->service->update($project, $data);

        return response()->json(new ProjectResource($project));
    }

    public function destroy(Project $project): JsonResponse
    {
        $this->authorize('delete', $project);

        $this->deleteImage($project->thumbnail);
        $project->images->each(fn (ProjectImage $image) => $this->deleteImage($image->image_path));

        $this->service->delete($project);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function destroyImage(Project $project, ProjectImage $image): JsonResponse
    {
        $this->authorize('update', $project);

        abort_if($image->project_id !== $project->id, Response::HTTP_NOT_FOUND);

        $this->deleteImage($image->image_path);
        $image->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    private function processUploads(Request $request, array $data): array
    {
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'projects');
        }

        if (! empty($data['images'])) {
            $data['images'] = collect($data['images'])
                ->map(function (array $image, int $index) use ($request) {
                    $file = $request->file("images.{$index}.file");

                    return [
                        'path' => $this->storeImage($file, 'projects'),
                        'alt_text' => $image['alt_text'] ?? null,
                        'sort_order' => $index,
                    ];
                })
                ->all();
        }

        return $data;
    }
}
