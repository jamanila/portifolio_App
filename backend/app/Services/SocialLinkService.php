<?php

namespace App\Services;

use App\Models\SocialLink;
use App\Repositories\Contracts\SocialLinkRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SocialLinkService
{
    public function __construct(private SocialLinkRepositoryInterface $repository) {}

    public function list(): Collection
    {
        return $this->repository->all();
    }

    public function active(): Collection
    {
        return $this->repository->active();
    }

    public function create(array $data): SocialLink
    {
        return $this->repository->create($data);
    }

    public function update(SocialLink $socialLink, array $data): SocialLink
    {
        return $this->repository->update($socialLink, $data);
    }

    public function delete(SocialLink $socialLink): bool
    {
        return $this->repository->delete($socialLink);
    }
}
