<?php

namespace Modules\Branch\Http\Controllers\Admin;

use App\Imports\InvoiceItemsImport;
use App\Imports\InvoicesImport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchCredential;
use Modules\Branch\Http\Requests\Admin\BranchCredentialRequest;
use Modules\Branch\Http\Requests\Admin\BranchRequest;
use Modules\Branch\Services\SendInvoiceService;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Branch $branch)
    {
        return Inertia::render('Branches/Invoices/Index', [
            'invoices' => $branch->invoices()->paginate(15),
            'branch' => $branch
        ]);
    }
    public function showUpload()
    {
        return Inertia::render('Branches/Invoices/Upload', [
            'branches' => Branch::all()
        ]);
    }
    public function upload(Request $request)
    {
        $request->validate([
            'tickets' => 'required|file',
            'items' => 'required|file',
            'branch' => 'required|numeric|exists:branches,id'
        ]);
        $branch = Branch::findOrFail($request->get('branch'));
        DB::table('invoices')->where('branch_id', $branch->id)->delete();
        DB::table('invoice_items')->where('branch_id', $branch->id)->delete();
        if ($request->file('tickets')) {
            Excel::queueImport(new InvoicesImport($branch->id), $request->file('tickets'))->allOnQueue('invoices');
        }
        if ($request->file('items')) {
            Excel::queueImport(new InvoiceItemsImport($branch->id), $request->file('items'))->allOnQueue('invoices');
        }
        return \success_add('');
    }
    public function showSend()
    {
        return Inertia::render('Branches/Invoices/Send', [
            'branches' => Branch::all()
        ]);
    }
    public function send(Request $request)
    {
        abort_if(DB::table('jobs')->count(), '400', 'There is a processing invoices job in queue, please try again later');
        $request->validate([
            'branch' => 'required|numeric|exists:branches,id',
            'filter_date' => 'required|date',
            'is_prod' => 'required|boolean'
        ]);
        $branch = Branch::with([
            'address'
        ])->firstWhere('id', $request->get('branch'));
        $credential = BranchCredential::where('branch_id', $branch->id)
            ->where('is_prod', $request->get('is_prod'))
            ->first();
        if (!$credential) {
            return \abort(400, 'Branch Credential Not Found');
        }
        SendInvoiceService::send($branch, $credential, $request->get('filter_date'));
    }
}