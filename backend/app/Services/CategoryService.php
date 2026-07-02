<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(private CategoryRepositoryInterface $repository) {}

    public function list(): Collection
    {
        return $this->repository->all();
    }

    public function findBySlug(string $slug): ?Category
    {
        return $this->repository->findBySlug($slug);
    }

    public function create(array $data): Category
    {
        return $this->repository->create($data);
    }

    public function update(Category $category, array $data): Category
    {
        return $this->repository->update($category, $data);
    }

    public function delete(Category $category): bool
    {
        return $this->repository->delete($category);
    }
}
