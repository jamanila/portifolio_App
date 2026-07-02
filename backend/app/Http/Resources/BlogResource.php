<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->when($request->routeIs('*.show'), $this->content),
            'thumbnail' => $this->thumbnail ? Storage::disk('public')->url($this->thumbnail) : null,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
