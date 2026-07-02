<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    public function __construct(private ProjectRepositoryInterface $repository) {}

    public function published(): Collection
    {
        return $this->repository->published();
    }

    public function featured(): Collection
    {
        return $this->repository->featured();
    }

    public function filter(array $filters, bool $onlyPublished = true): Collection
    {
        return $this->repository->filter($filters, $onlyPublished);
    }

    public function findBySlug(string $slug): ?Project
    {
        return $this->repository->findBySlug($slug);
    }

    public function create(array $data): Project
    {
        return DB::transaction(function () use ($data) {
            $technologyIds = $data['technology_ids'] ?? [];
            $images = $data['images'] ?? [];
            unset($data['technology_ids'], $data['images']);

            /** @var Project $project */
            $project = $this->repository->create($data);
            $project->technologies()->sync($technologyIds);
            $this->syncImages($project, $images);

            return $project->load(['category', 'technologies', 'images']);
        });
    }

    public function update(Project $project, array $data): Project
    {
        return DB::transaction(function () use ($project, $data) {
            $technologyIds = $data['technology_ids'] ?? null;
            $images = $data['images'] ?? null;
            unset($data['technology_ids'], $data['images']);

            $project = $this->repository->update($project, $data);

            if ($technologyIds !== null) {
                $project->technologies()->sync($technologyIds);
            }

            if ($images !== null) {
                $this->syncImages($project, $images);
            }

            return $project->load(['category', 'technologies', 'images']);
        });
    }

    public function delete(Project $project): bool
    {
        return $this->repository->delete($project);
    }

    private function syncImages(Project $project, array $images): void
    {
        foreach ($images as $index => $image) {
            $project->images()->create([
                'image_path' => $image['path'],
                'alt_text' => $image['alt_text'] ?? null,
                'sort_order' => $image['sort_order'] ?? $index,
            ]);
        }
    }
}
