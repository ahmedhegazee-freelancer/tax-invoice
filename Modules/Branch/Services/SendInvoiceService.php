<?php

namespace Modules\Branch\Services;

use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\DB;
use Modules\Branch\Entities\Branch;
use Illuminate\Support\Facades\Http;
use Modules\Branch\DataTransferObjects\SendInvoiceDto;
use Modules\Branch\Entities\BranchCredential;
use Termwind\Components\Dd;

class SendInvoiceService
{
    public static function handle(Branch $branch,  BranchCredential $credential, string $date, bool $status = false)
    {
        $invoices = Invoice::select(['id'])
            ->whereDate('closing_date', $date)
            ->where('branch_id', $branch->id)
            ->get();
        if ($invoices->count() == 0)
            abort(400, 'No Invoices Found');
        $invoices = InvoiceService::make()
            ->formatInvoices(
                $branch,
                $invoices->pluck('id')->toArray(),
                $credential->device_serial_number,
                $status
            );
        $dto = SendInvoiceDto::make($credential, $invoices);
        self::send($dto);
    }
    public static function getToken(BranchCredential $credential)
    {
        $idUrl = "";
        if (!$credential->is_prod) {
            $idUrl = "https://id.preprod.eta.gov.eg/connect/token";
        } else {
            $idUrl = "https://id.eta.gov.eg/connect/token";
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
            return $json['access_token'];
        else {
            abort(400, 'Invalid Credentials');
        }
    }
    public static function markSentReceipts($json)
    {
        if (isset($json['acceptedDocuments'])) {
            $receipts = collect($json['acceptedDocuments'])->pluck('receiptNumber');
            DB::table('send_invoices')->whereIn('ticket_id', $receipts)->update(['is_sent' => true]);
        }
    }
    public static function send(SendInvoiceDto $dto)
    {
        $json = Http::withHeaders([
            'Authorization' => 'Bearer ' . $dto->getToken(),
        ])->withBody(json_encode([
            'receipts' => $dto->getInvoices(),
        ], JSON_PRESERVE_ZERO_FRACTION), 'application/json')
            ->post($dto->getApiUrl())->json();
        dump($json);
        self::markSentReceipts($json);
    }
}