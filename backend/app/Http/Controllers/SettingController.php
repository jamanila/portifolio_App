<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    use HandlesUploads;

    public function __construct(private SettingService $settingService) {}

    public function show(): JsonResponse
    {
        return response()->json(new SettingResource($this->settingService->current()));
    }

    public function update(UpdateSettingRequest $request): JsonResponse
    {
        $this->authorize('update', Setting::class);

        $setting = $this->settingService->current();
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $this->deleteImage($setting->logo);
            $data['logo'] = $this->storeImage($request->file('logo'), 'settings');
        }

        if ($request->hasFile('favicon')) {
            $this->deleteImage($setting->favicon);
            $data['favicon'] = $this->storeImage($request->file('favicon'), 'settings');
        }

        $setting = $this->settingService->update($data);

        return response()->json(new SettingResource($setting));
    }
}
