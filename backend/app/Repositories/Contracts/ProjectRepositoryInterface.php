<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ProjectRepositoryInterface extends RepositoryInterface
{
    public function published(): Collection;

    public function featured(): Collection;

    public function filter(array $filters, bool $onlyPublished = true): Collection;
}
