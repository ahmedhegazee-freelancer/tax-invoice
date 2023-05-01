<?php

namespace Modules\CustomerMessage\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CustomerMessage\Entities\CustomerMessage;

class CustomerMessageController extends Controller
{
    public function index()
    {
        return \Inertia\Inertia::render('CustomerMessages/Index', [
            'messages' => CustomerMessage::with('user')->latest()->paginate(10),
        ]);
    }
    public function destroy(CustomerMessage $message)
    {
        $message->delete();
        return \success_delete('');
    }
}