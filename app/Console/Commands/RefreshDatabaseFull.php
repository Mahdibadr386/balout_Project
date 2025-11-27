<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshDatabaseFull extends Command
{
    protected $signature = 'db:refresh-full';
    protected $description = 'Wipe, import tables, migrate with seed, and create personal passport client';

    public function handle()
    {
        $this->line('Starting full database refresh...');

        $this->runStep('Wiping database', 'db:wipe');
        $this->runStep('Importing base tables', 'import:tables');
        $this->runStep('Running migrations with seed', 'migrate --seed');
        $this->runStep('Creating Passport personal client', 'passport:client --personal');

        $this->info('Database fully refreshed.');
        return Command::SUCCESS;
    }

    protected function runStep(string $message, string $command)
    {
        $this->comment("→ {$message}");

        $exit = Artisan::call($command);

        if ($exit !== 0) {
            $this->error("Command failed: {$command}");
        }

        $this->line(Artisan::output());
    }
}
