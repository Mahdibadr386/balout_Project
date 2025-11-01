<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSqlCommand extends Command
{
    protected $signature = 'import:tables';
    protected $description = 'Import external tables located in storage/app to database';

    public function handle()
    {
        DB::unprepared(file_get_contents(database_path('migrations/cities.sql')));
        DB::unprepared(file_get_contents(database_path('migrations/districts.sql')));

        $this->info('Tables imported successfully.');
    }
}
