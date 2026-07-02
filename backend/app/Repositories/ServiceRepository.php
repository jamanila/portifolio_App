<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function ordered(): Collection
    {
        return $this->model->newQuery()->orderBy('sort_order')->get();
    }
}
