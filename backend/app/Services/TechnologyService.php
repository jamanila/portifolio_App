<?php

namespace App\Services;

use App\Models\Technology;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TechnologyService
{
    public function __construct(private TechnologyRepositoryInterface $repository) {}

    public function list(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Technology
    {
        return $this->repository->create($data);
    }

    public function update(Technology $technology, array $data): Technology
    {
        return $this->repository->update($technology, $data);
    }

    public function delete(Technology $technology): bool
    {
        return $this->repository->delete($technology);
    }
}
