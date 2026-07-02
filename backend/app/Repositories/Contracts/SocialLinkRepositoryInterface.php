<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SocialLinkRepositoryInterface extends RepositoryInterface
{
    public function active(): Collection;
}
