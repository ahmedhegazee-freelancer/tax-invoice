<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Auth\Entities\Otp;

class DeleteExpiredOtpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:expired-otps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Expired otp';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Otp::where('expired_at', '<', now()->toDateTimeString())->delete();
        return Command::SUCCESS;
    }
}