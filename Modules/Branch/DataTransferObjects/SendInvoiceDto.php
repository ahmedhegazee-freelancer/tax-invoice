<?php


namespace Modules\Branch\DataTransferObjects;

use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchCredential;
use Modules\Branch\Services\SendInvoiceService;

class SendInvoiceDto
{
    public function __construct(
        private BranchCredential $credential,
        private array $invoices,
    ) {
    }
    public static function make(
        BranchCredential $credential,
        array $invoices,
    ): SendInvoiceDto {
        return new self($credential, $invoices);
    }
    public function getToken(): string
    {
        return SendInvoiceService::getToken($this->credential);
    }
    public function getApiUrl()
    {
        if ($this->credential->is_prod)
            return  "https://api.invoicing.eta.gov.eg/api/v1/receiptsubmissions";
        return "https://api.preprod.invoicing.eta.gov.eg/api/v1/receiptsubmissions";
    }
    public function getInvoices(): array
    {
        return $this->invoices;
    }
    public function isProduction()
    {
        return $this->credential->is_prod;
    }
}