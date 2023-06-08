<?php

namespace Modules\Branch\Http\Controllers\Admin;

use App\Imports\InvoiceItemsImport;
use App\Imports\InvoicesImport;
use App\Models\SendInvoice;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Branch\DataTransferObjects\SendInvoiceDto;
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
            'items' => 'nullable|file',
            'branch' => 'required|numeric|exists:branches,id'
        ]);
        $branch = Branch::findOrFail($request->get('branch'));
        DB::table('invoices')->where('branch_id', $branch->id)->delete();
        if ($request->file('items'))
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
        SendInvoiceService::handle($branch, $credential, $request->get('filter_date'), $request->get('is_prod'));
        dd('');
    }
    public function showUnsentInvoices()
    {
        $invoices = $this->getInvoices()->paginate();
        return Inertia::render('Branches/Invoices/Unsent', [
            'branches' => Branch::all(),
            'invoices' => $invoices
        ]);
    }
    public function sendInvoices()
    {
        $invoices = $this->getInvoices()->get();
        //group by branch
        $invoices = $invoices->groupBy('branch_id');
        foreach ($invoices as $branch_id => $branchInvoices) {
            //group by is_prod
            $invoicesGroupedStatus = $branchInvoices->groupBy('is_prod');
            foreach ($invoicesGroupedStatus as $is_prod => $invoice) {
                $branch = Branch::with([
                    'address',
                    'credentials' => fn ($query) => $query->where('is_prod', $is_prod)
                ])->findOrFail($branch_id);
                $dto = SendInvoiceDto::make(
                    $branch->credentials->first(),
                    $invoice->pluck('data')->map(fn ($item) => json_decode($item, true))->toArray(),
                );
                SendInvoiceService::send($dto);
            }
        }
        dd('');
    }
    public function exportJson()
    {
        $invoices = $this->getInvoices()->get();
        $invoices = $invoices->groupBy('branch_id');
        $formattedInvoices = [];
        foreach ($invoices as $branch_id => $branchInvoices) {
            //group by is_prod
            $invoicesGroupedStatus = $branchInvoices->groupBy('is_prod');
            foreach ($invoicesGroupedStatus as $is_prod => $invoice) {
                $branch = Branch::with([
                    'address',
                    'credentials' => fn ($query) => $query->where('is_prod', $is_prod)
                ])->findOrFail($branch_id);
                $formattedInvoices[] = [
                    'branch' => $branch->name,
                    'is_prod' => $is_prod,
                    'invoices' => $invoice->pluck('data')->map(fn ($item) => json_decode($item, true))->toArray()
                ];
            }
        }
        return response()->streamDownload(function () use ($formattedInvoices) {
            echo json_encode($formattedInvoices, JSON_PRETTY_PRINT);
        }, 'formatted-invoices.json');
    }
    private function getInvoices()
    {
        return DB::table('send_invoices')
            ->when(request()->get('branch'), function ($query) {
                $query->where('branch_id', request()->get('branch'));
            })
            ->when(request()->get('date'), function (Builder $query) {
                $query->whereDate('date', '>=', request()->get('date')[0])->whereDate('date', '<=', request()->get('date')[1]);
            })
            ->when(request()->get('is_prod'), function ($query) {
                $query->where('is_prod', request()->get('is_prod') == 'true');
            })
            ->where('is_sent', false);
    }
}