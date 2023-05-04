<?php

namespace App\Services;

use App\Jobs\SendInvoicesJob;
use App\Models\BranchAddressSetting;
use App\Models\Invoice;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Modules\Branch\Entities\Branch;

class InvoiceService
{
    private static $instance;
    private function __construct()
    {
    }
    public static function make(): InvoiceService
    {
        if (is_null(static::$instance))
            static::$instance = new self();
        return static::$instance;
    }
    public function getLastInvoiceDate()
    {
        return Cache::rememberForever('last-date', function () {
            return DB::table('invoices')->select(['closing_date'])->orderByDesc('closing_date')->limit(1)->first()?->closing_date;
        });
    }
    public function getLastInvoiceItemDate()
    {
        return Cache::rememberForever('item-last-date', function () {
            return DB::table('invoice_items')->select(['create_date'])->orderByDesc('create_date')->limit(1)->first()?->create_date;
        });
    }
    public function send(array $invoices)
    {
        $signatures = SignaturesService::make()->get();
        Http::post('', [
            'receipts' => $invoices,
            'signatures' => $signatures,
        ]);
    }
    public function getPrevious($date)
    {
        return Invoice::select(['ticket_id'])
            ->where(function ($query) use ($date) {
                $query->where('paid', true)
                    ->where('deleted', false)
                    ->where('voided', false)
                    ->whereNotNull('closing_date')
                    ->where('closing_date', '<', $date);
            })
            ->orderByDesc('closing_date')->limit(1)->first();
    }
    public function formatInvoices(Branch $branch, array $invoicesIds, string $deviceID)
    {
        $service = InvoiceFormatter::make();
        $receipts = [];
        $invoices = Invoice::with('items')
            ->where(function ($query) {
                $query->where('paid', true)
                    ->where('deleted', false)
                    ->where('voided', false)
                    ->whereNotNull('closing_date');
            })
            ->whereIn('id', $invoicesIds)
            ->get();
        $addressSettings = BranchAddressSetting::where('branch_id', $branch->id)
            ->select(['key', 'value'])
            ->get()
            ->pluck('value', 'key')
            ->toArray();
        foreach ($invoices as $key => $invoice) {
            $previous = "";
            // if ($key == 0) {
            //     $previousId = $this->getPrevious($invoice->closing_date);
            //     if (!is_null($previousId))
            //         $previous = $previousId->ticket_id;
            // } else {
            //     $previous = $invoices->get($key - 1)->ticket_id;
            // }

            $formattedInvoice = $service->initialize($addressSettings)->format($invoice, $deviceID, $branch);
            // dump($formattedInvoice);
            // dump(InvoiceFormatter::flattenJson($formattedInvoice));
            $uuid = Str::upper(hash('sha256', InvoiceFormatter::flattenJson($formattedInvoice)));
            dump('uuid:' . $uuid . " id:" . $invoice->id);
            $formattedInvoice['header']['uuid'] = $uuid;
            $receipts[] = $formattedInvoice;
        }

        return $receipts;
    }
    // public function generateInvoiceJobs(string $startDate = null)
    // {
    //     DB::table('invoices')->select(['id'])
    //         ->when($startDate, fn ($query) => $query->whereDate('closing_date', '>=', $startDate))
    //         ->where('paid', true)
    //         ->where('deleted', false)
    //         ->where('voided', false)
    //         ->orderBy('id')
    //         ->chunk(10, function ($chunk) {
    //             SendInvoicesJob::dispatch($chunk->pluck('id')->toArray())->onQueue('send-invoices');
    //         });
    //     // $invoices = Invoice::select(['closing_date', 'ticket_id', 'sub_total', 'total', 'discount', 'tax', 'fees', 'terminal_id', 'id'])
    //     //     ->with('items')
    //     //     ;
    // }
}