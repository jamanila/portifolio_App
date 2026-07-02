<?php

namespace App\Repositories;

use App\Models\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ContactMessageRepository extends BaseRepository implements ContactMessageRepositoryInterface
{
    public function __construct(ContactMessage $model)
    {
        parent::__construct($model);
    }

    public function unread(): Collection
    {
        return $this->model->newQuery()
            ->where('is_read', false)
            ->latest()
            ->get();
    }
}
