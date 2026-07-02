<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface extends RepositoryInterface
{
    public function ordered(): Collection;
}
