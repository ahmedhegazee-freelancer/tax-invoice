<?php

namespace Modules\Banner\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Banner\Entities\Banner;
use Modules\Banner\Transformers\BannersResource;

class BannerController extends Controller
{
    public function __invoke()
    {
        return BannersResource::collection(Banner::select(['url'])->translate()->paginate(15));
    }
}