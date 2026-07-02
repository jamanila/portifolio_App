<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ContactMessageRepositoryInterface extends RepositoryInterface
{
    public function unread(): Collection;
}
