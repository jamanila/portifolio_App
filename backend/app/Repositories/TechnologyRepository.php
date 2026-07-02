<?php

namespace App\Repositories;

use App\Models\Technology;
use App\Repositories\Contracts\TechnologyRepositoryInterface;

class TechnologyRepository extends BaseRepository implements TechnologyRepositoryInterface
{
    public function __construct(Technology $model)
    {
        parent::__construct($model);
    }
}
