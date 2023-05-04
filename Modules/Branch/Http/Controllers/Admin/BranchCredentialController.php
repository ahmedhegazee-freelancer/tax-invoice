<?php

namespace Modules\Branch\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchCredential;
use Modules\Branch\Http\Requests\Admin\BranchCredentialRequest;
use Modules\Branch\Http\Requests\Admin\BranchRequest;

class BranchCredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Branch $branch)
    {
        return Inertia::render('Branches/Credentials/Index', [
            'credentials' => $branch->credentials,
            'branch' => $branch
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Branch $branch)
    {
        return Inertia::render('Branches/Credentials/Create', [
            'branch' => $branch
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BranchCredentialRequest $request, Branch $branch)
    {
        $branch->credentials()->create($request->all());
        return \success_add('branch.index');
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Branch $branch, BranchCredential $credential)
    {
        $credential->delete();
        return \success_delete('');
    }
}