<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public function current(): Setting
    {
        return Setting::current();
    }

    public function update(Setting $setting, array $data): Setting
    {
        $setting->update($data);

        return $setting;
    }
}
