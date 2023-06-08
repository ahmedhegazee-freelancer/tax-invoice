<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchCredential;
use Modules\Branch\Services\SendInvoiceService;

class SendInvoicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:invoices {branch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Invoices';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $branch = Branch::with([
            'address',
            'credentials' => fn ($query) => $query->where('is_prod', true)
        ])->findOrFail($this->argument('branch'));

        // foreach ($branches as $branch) {
        SendInvoiceService::handle($branch, $branch->credentials->first(), now()->subDay()->format('Y-m-d'), true);
        // }
    }
}
