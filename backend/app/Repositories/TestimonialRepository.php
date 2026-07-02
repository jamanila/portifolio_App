<?php

namespace App\Repositories;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TestimonialRepository extends BaseRepository implements TestimonialRepositoryInterface
{
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }

    public function featured(): Collection
    {
        return $this->model->newQuery()
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get();
    }
}
