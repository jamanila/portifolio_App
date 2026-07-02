<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'site_name' => $this->site_name,
            'site_title' => $this->site_title,
            'site_description' => $this->site_description,
            'logo' => $this->logo ? Storage::disk('public')->url($this->logo) : null,
            'favicon' => $this->favicon ? Storage::disk('public')->url($this->favicon) : null,
            'photo' => $this->photo ? Storage::disk('public')->url($this->photo) : null,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'resume_url' => $this->resume_url,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ];
    }
}
