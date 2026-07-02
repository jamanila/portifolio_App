<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->when($request->routeIs('*.show'), $this->description),
            'features' => $this->features,
            'thumbnail' => $this->thumbnail ? Storage::disk('public')->url($this->thumbnail) : null,
            'price' => $this->price,
            'license' => $this->license,
            'documentation_url' => $this->documentation_url,
            'demo_url' => $this->demo_url,
            'is_featured' => $this->is_featured,
            'status' => $this->status,
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
