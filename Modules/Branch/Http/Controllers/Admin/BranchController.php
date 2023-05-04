<?php

namespace Modules\Branch\Http\Controllers\Admin;

use App\Models\BranchAddressSetting;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Http\Requests\Admin\BranchRequest;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $branches = Branch::paginate(15);
        return Inertia::render('Branches/Index', [
            'branches' => $branches,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('Branches/Create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BranchRequest $request)
    {

        $branch = Branch::create($request->all());
        BranchAddressSetting::insert([
            ['key' => 'country', 'value' => 'EG', 'branch_id' => $branch->id],
            ['key' => 'governate', 'value' => 'cairo', 'branch_id' => $branch->id],
            ['key' => 'regionCity', 'value' => 'city center', 'branch_id' => $branch->id],
            ['key' => 'street', 'value' => 'CFC', 'branch_id' => $branch->id],
            ['key' => 'buildingNumber', 'value' => '18', 'branch_id' => $branch->id],
        ]);
        return \success_add('branch.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return \success_delete('');
    }
}