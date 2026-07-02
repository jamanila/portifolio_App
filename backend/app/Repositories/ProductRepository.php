<?php

namespace App\Repositories;

use App\Enums\PublishStatus;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function published(): Collection
    {
        return $this->model->newQuery()
            ->with('images')
            ->where('status', PublishStatus::Published)
            ->orderBy('sort_order')
            ->get();
    }

    public function featured(): Collection
    {
        return $this->model->newQuery()
            ->with('images')
            ->where('status', PublishStatus::Published)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function filter(array $filters, bool $onlyPublished = true): Collection
    {
        $query = $this->model->newQuery()->with('images');

        if ($onlyPublished) {
            $query->where('status', PublishStatus::Published);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function (Builder $q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
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
