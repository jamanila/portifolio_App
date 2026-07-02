<?php

namespace App\Repositories;

use App\Models\SocialLink;
use App\Repositories\Contracts\SocialLinkRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SocialLinkRepository extends BaseRepository implements SocialLinkRepositoryInterface
{
    public function __construct(SocialLink $model)
    {
        parent::__construct($model);
    }

    public function active(): Collection
    {
        return $this->model->newQuery()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }
}
