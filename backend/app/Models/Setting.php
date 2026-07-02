<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_title',
        'site_description',
        'logo',
        'favicon',
        'photo',
        'email',
        'phone',
        'address',
        'resume_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], ['site_name' => config('app.name')]);
    }
}
