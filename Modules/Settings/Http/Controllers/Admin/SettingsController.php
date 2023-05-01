<?php

namespace Modules\Settings\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Settings\Entities\Setting;
use Modules\Settings\Http\Requests\SettingRequest;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return Inertia::render('Settings/Index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SettingRequest $request)
    {

        $formattedData = [];
        foreach ($request->validated() as    $key => $setting) {
            $formattedData[] = ['key' => $key, 'value' => $setting];
        }
        Setting::upsert($formattedData, ['key'], ['value']);
        return success_update('');
    }
}