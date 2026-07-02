<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'client_name' => $this->client_name,
            'client_photo' => $this->client_photo ? Storage::disk('public')->url($this->client_photo) : null,
            'company' => $this->company,
            'review' => $this->review,
            'rating' => $this->rating,
            'is_featured' => $this->is_featured,
        ];
    }
}
