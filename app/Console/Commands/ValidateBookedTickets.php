<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ValidateBookedTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validate:tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate Tickets';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}