<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    public function published(): Collection
    {
        return $this->model->newQuery()
            ->where('is_published', true)
            ->latest('published_at')
            ->get();
    }
}
