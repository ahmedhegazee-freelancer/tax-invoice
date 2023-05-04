<?php

namespace Modules\Branch\Http\Controllers\Admin;

use App\Models\BranchAddressSetting;
use App\Models\BusinessSetting;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchCredential;
use Modules\Branch\Http\Requests\Admin\BranchCredentialRequest;
use Modules\Branch\Http\Requests\Admin\BranchRequest;

class BusinessSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('BusinessSetting/Index', [
            'settings' => BusinessSetting::all(),
        ]);
    }
    public function edit(BusinessSetting $setting)
    {
        return Inertia::render('BusinessSetting/Update', [
            'setting' => $setting,
        ]);
    }
    public function update(Request $request,  BusinessSetting $setting)
    {
        $setting->update($request->all());
        return \success_update('');
    }
}