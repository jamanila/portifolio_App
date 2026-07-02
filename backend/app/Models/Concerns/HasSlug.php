<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug();
            }
        });
    }

    protected function slugSourceField(): string
    {
        return property_exists($this, 'slugSource') ? $this->slugSource : 'name';
    }

    protected function generateUniqueSlug(): string
    {
        $source = $this->{$this->slugSourceField()};
        $base = Str::slug($source);
        $slug = $base;
        $suffix = 1;

        while (static::query()->where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
