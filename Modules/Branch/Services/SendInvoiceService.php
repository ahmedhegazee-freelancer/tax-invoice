<?php

namespace Modules\Branch\Services;

use App\Models\Invoice;
use App\Services\InvoiceService;
use Modules\Branch\Entities\Branch;
use Illuminate\Support\Facades\Http;
use Modules\Branch\Entities\BranchCredential;

class SendInvoiceService
{
    public static function send(Branch $branch,  BranchCredential $credential, string $date)
    {
        $invoices = Invoice::select(['id'])
            ->whereDate('closing_date', $date)
            ->where('branch_id', $branch->id)
            ->get();

        if ($invoices->count() == 0)
            abort(400, 'No Invoices Found');
        $idUrl = "";
        $apiUrl = "";
        if (!$credential->is_prod) {
            $idUrl = "https://id.preprod.eta.gov.eg/connect/token";
            $apiUrl = "https://api.preprod.invoicing.eta.gov.eg/api/v1/receiptsubmissions";
        } else {
            $idUrl = "https://id.eta.gov.eg/connect/token";
            $apiUrl = "https://api.invoicing.eta.gov.eg/api/v1/receiptsubmissions";
        }
        $json = Http::withHeaders([
            "pososversion" => $credential->pos_os_version,
            "posserial" => $credential->device_serial_number,
            'presharedkey' => '',
        ])->asForm()->post($idUrl, [
            "client_id" => $credential->client_id,
            "client_secret" => $credential->client_secret,
            'grant_type' => 'client_credentials',
        ])->json();
        if (isset($json['access_token']))
            $token = $json['access_token'];
        else {
            abort(400, 'Invalid Credentials');
        }

        // dd(InvoiceService::make()
        //     ->formatInvoices(
        //         $branch,
        //         $invoices->pluck('id')
        //             ->toArray(),
        //         $credential->device_serial_number
        //     ));
        $json = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->withBody(json_encode([
            'receipts' => InvoiceService::make()
                ->formatInvoices(
                    $branch,
                    $invoices->pluck('id')
                        ->toArray(),
                    $credential->device_serial_number
                ),
            // 'receipts' => InvoiceService::make()->formatInvoices([4]),
        ], JSON_PRESERVE_ZERO_FRACTION), 'application/json')
            ->post($apiUrl)->json();
        dd($json);
    }
}