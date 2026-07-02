<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->when($request->routeIs('*.show'), $this->description),
            'features' => $this->features,
            'challenges' => $this->challenges,
            'solutions' => $this->solutions,
            'thumbnail' => $this->thumbnail ? Storage::disk('public')->url($this->thumbnail) : null,
            'demo_url' => $this->demo_url,
            'repo_url' => $this->repo_url,
            'demo_video_url' => $this->demo_video_url,
            'price' => $this->price,
            'is_purchasable' => $this->is_purchasable,
            'is_featured' => $this->is_featured,
            'status' => $this->status,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'technologies' => TechnologyResource::collection($this->whenLoaded('technologies')),
            'images' => ProjectImageResource::collection($this->whenLoaded('images')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
