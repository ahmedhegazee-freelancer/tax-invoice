<?php

namespace Modules\Branch\Http\Controllers\Admin;

use App\Models\BranchAddressSetting;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchCredential;
use Modules\Branch\Http\Requests\Admin\BranchCredentialRequest;
use Modules\Branch\Http\Requests\Admin\BranchRequest;

class BranchAddressSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Branch $branch)
    {
        return Inertia::render('Branches/Address/Index', [
            'address' => $branch->address,
            'branch' => $branch
        ]);
    }
    public function edit(Branch $branch, BranchAddressSetting $address)
    {
        return Inertia::render('Branches/Address/Update', [
            'address' => $address,
            'branch' => $branch
        ]);
    }
    public function update(Request $request, Branch $branch, BranchAddressSetting $address)
    {
        $address->update($request->all());
        return \success_update('');
    }
}