<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BlogRepositoryInterface extends RepositoryInterface
{
    public function published(): Collection;
}
