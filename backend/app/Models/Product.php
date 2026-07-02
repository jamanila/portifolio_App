<?php

namespace App\Models;

use App\Enums\PublishStatus;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'features',
        'thumbnail',
        'price',
        'license',
        'documentation_url',
        'demo_url',
        'is_featured',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'price' => 'decimal:2',
            'is_featured' => 'boolean',
            'status' => PublishStatus::class,
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
