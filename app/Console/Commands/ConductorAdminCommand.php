<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ConductorAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info(User::role('admin')->first()?->createToken('*')?->plainTextToken);

        return 0;
    }
}
