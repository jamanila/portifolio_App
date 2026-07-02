<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, HasSlug;

    protected string $slugSource = 'title';

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'description',
        'benefits',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'benefits' => 'array',
        ];
    }
}
