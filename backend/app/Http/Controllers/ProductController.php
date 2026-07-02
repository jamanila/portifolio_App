<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    use HandlesUploads;

    public function __construct(private ProductService $service) {}

    public function index(Request $request): JsonResponse
    {
        if ($request->boolean('featured')) {
            $products = $this->service->featured();
        } else {
            $products = $this->service->filter(
                $request->only(['search', 'sort']),
                onlyPublished: ! $request->user('sanctum')
            );
        }

        return response()->json(ProductResource::collection($products));
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json(new ProductResource($product->load('images')));
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();
        $data = $this->processUploads($request, $data);

        $product = $this->service->create($data);

        return response()->json(new ProductResource($product), Response::HTTP_CREATED);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $this->authorize('update', $product);

        $data = $request->validated();
        $data = $this->processUploads($request, $data);

        $product = $this->service->update($product, $data);

        return response()->json(new ProductResource($product));
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);

        $this->deleteImage($product->thumbnail);
        $product->images->each(fn (ProductImage $image) => $this->deleteImage($image->image_path));

        $this->service->delete($product);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function destroyImage(Product $product, ProductImage $image): JsonResponse
    {
        $this->authorize('update', $product);

        abort_if($image->product_id !== $product->id, Response::HTTP_NOT_FOUND);

        $this->deleteImage($image->image_path);
        $image->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    private function processUploads(Request $request, array $data): array
    {
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'products');
        }

        if (! empty($data['images'])) {
            $data['images'] = collect($data['images'])
                ->map(function (array $image, int $index) use ($request) {
                    $file = $request->file("images.{$index}.file");

                    return [
                        'path' => $this->storeImage($file, 'products'),
                        'alt_text' => $image['alt_text'] ?? null,
                        'sort_order' => $index,
                    ];
                })
                ->all();
        }

        return $data;
    }
}
