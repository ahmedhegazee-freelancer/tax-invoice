<?php

namespace Modules\CustomerMessage\Http\Controllers\Api;

use App\Helpers\JsonResponseMessages;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CustomerMessage\Http\Requests\CustomerMessageRequest;

class CustomerMessageController extends Controller
{
    public function __invoke(CustomerMessageRequest $request)
    {
        auth()->user()->messages()->create($request->validated());
        return JsonResponseMessages::created();
    }
}