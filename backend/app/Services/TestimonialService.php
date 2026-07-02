<?php

namespace App\Services;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TestimonialService
{
    public function __construct(private TestimonialRepositoryInterface $repository) {}

    public function list(): Collection
    {
        return $this->repository->all();
    }

    public function featured(): Collection
    {
        return $this->repository->featured();
    }

    public function create(array $data): Testimonial
    {
        return $this->repository->create($data);
    }

    public function update(Testimonial $testimonial, array $data): Testimonial
    {
        return $this->repository->update($testimonial, $data);
    }

    public function delete(Testimonial $testimonial): bool
    {
        return $this->repository->delete($testimonial);
    }
}
