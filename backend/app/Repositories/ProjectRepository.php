<?php

namespace App\Repositories;

use App\Enums\PublishStatus;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function published(): Collection
    {
        return $this->model->newQuery()
            ->with(['category', 'technologies', 'images'])
            ->where('status', PublishStatus::Published)
            ->orderBy('sort_order')
            ->get();
    }

    public function featured(): Collection
    {
        return $this->model->newQuery()
            ->with(['category', 'technologies', 'images'])
            ->where('status', PublishStatus::Published)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function filter(array $filters, bool $onlyPublished = true): Collection
    {
        $query = $this->model->newQuery()->with(['category', 'technologies', 'images']);

        if ($onlyPublished) {
            $query->where('status', PublishStatus::Published);
        }

        if (! empty($filters['category'])) {
            $query->whereHas('category', fn (Builder $q) => $q->where('slug', $filters['category']));
        }

        if (! empty($filters['technology'])) {
            $query->whereHas('technologies', fn (Builder $q) => $q->where('slug', $filters['technology']));
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function (Builder $q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        return match ($filters['sort'] ?? null) {
            'oldest' => $query->oldest()->get(),
            'featured' => $query->orderByDesc('is_featured')->orderBy('sort_order')->get(),
            'price_asc' => $query->orderBy('price')->get(),
            'price_desc' => $query->orderByDesc('price')->get(),
            default => $query->orderBy('sort_order')->latest()->get(),
        };
    }
}
