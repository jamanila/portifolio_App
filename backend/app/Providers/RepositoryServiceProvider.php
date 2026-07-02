<?php

namespace App\Providers;

use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ContactMessageRepository;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Contracts\SocialLinkRepositoryInterface;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SocialLinkRepository;
use App\Repositories\TechnologyRepository;
use App\Repositories\TestimonialRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
        TechnologyRepositoryInterface::class => TechnologyRepository::class,
        ProjectRepositoryInterface::class => ProjectRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        ServiceRepositoryInterface::class => ServiceRepository::class,
        TestimonialRepositoryInterface::class => TestimonialRepository::class,
        ContactMessageRepositoryInterface::class => ContactMessageRepository::class,
        SocialLinkRepositoryInterface::class => SocialLinkRepository::class,
        BlogRepositoryInterface::class => BlogRepository::class,
        SettingRepositoryInterface::class => SettingRepository::class,
    ];
}
