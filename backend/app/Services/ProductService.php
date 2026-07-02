<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(private ProductRepositoryInterface $repository) {}

    public function published(): Collection
    {
        return $this->repository->published();
    }

    public function featured(): Collection
    {
        return $this->repository->featured();
    }

    public function filter(array $filters, bool $onlyPublished = true): Collection
    {
        return $this->repository->filter($filters, $onlyPublished);
    }

    public function findBySlug(string $slug): ?Product
    {
        return $this->repository->findBySlug($slug);
    }

    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $images = $data['images'] ?? [];
            unset($data['images']);

            /** @var Product $product */
            $product = $this->repository->create($data);
            $this->syncImages($product, $images);

            return $product->load('images');
        });
    }

    public function update(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            $images = $data['images'] ?? null;
            unset($data['images']);

            $product = $this->repository->update($product, $data);

            if ($images !== null) {
                $this->syncImages($product, $images);
            }

            return $product->load('images');
        });
    }

    public function delete(Product $product): bool
    {
        return $this->repository->delete($product);
    }

    private function syncImages(Product $product, array $images): void
    {
        foreach ($images as $index => $image) {
            $product->images()->create([
                'image_path' => $image['path'],
                'alt_text' => $image['alt_text'] ?? null,
                'sort_order' => $image['sort_order'] ?? $index,
            ]);
        }
    }
}
