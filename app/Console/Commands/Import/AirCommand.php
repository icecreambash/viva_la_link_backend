<?php

namespace App\Console\Commands\Import;

use Illuminate\Console\Command;

class AirCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:air-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from Excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd(123123);
    }
}
