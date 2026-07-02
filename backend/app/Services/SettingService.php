<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;

class SettingService
{
    public function __construct(private SettingRepositoryInterface $repository) {}

    public function current(): Setting
    {
        return $this->repository->current();
    }

    public function update(array $data): Setting
    {
        return $this->repository->update($this->repository->current(), $data);
    }
}
