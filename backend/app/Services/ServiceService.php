<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function __construct(private ServiceRepositoryInterface $repository) {}

    public function list(): Collection
    {
        return $this->repository->ordered();
    }

    public function create(array $data): Service
    {
        return $this->repository->create($data);
    }

    public function update(Service $service, array $data): Service
    {
        return $this->repository->update($service, $data);
    }

    public function delete(Service $service): bool
    {
        return $this->repository->delete($service);
    }
}
