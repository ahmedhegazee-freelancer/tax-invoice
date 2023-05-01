<?php

namespace Modules\Banner\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Modules\Banner\Entities\Banner;
use Modules\Banner\Http\Requests\Admin\BannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $banners = Banner::paginate(15);
        return Inertia::render('Banners/Index', [
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('Banners/Create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BannerRequest $request)
    {
        $bannersData = [];
        foreach ($request->images as $image) {
            $bannersData[] = [
                'locale' => $request->get('locale'),
                'url' => Storage::disk('banners')->putFile('', $image),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }
        Banner::insert($bannersData);
        return \success_add('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return \success_delete('');
    }
}