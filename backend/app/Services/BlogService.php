<?php

namespace App\Services;

use App\Models\Blog;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    public function __construct(private BlogRepositoryInterface $repository) {}

    public function list(): Collection
    {
        return $this->repository->all();
    }

    public function published(): Collection
    {
        return $this->repository->published();
    }

    public function findBySlug(string $slug): ?Blog
    {
        return $this->repository->findBySlug($slug);
    }

    public function create(array $data): Blog
    {
        return $this->repository->create($data);
    }

    public function update(Blog $blog, array $data): Blog
    {
        return $this->repository->update($blog, $data);
    }

    public function delete(Blog $blog): bool
    {
        return $this->repository->delete($blog);
    }
}
