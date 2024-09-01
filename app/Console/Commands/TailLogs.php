<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TailLogs extends Command
{
    protected $signature = 'logs:tail';
    protected $description = 'Tail the Laravel log file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $file = storage_path('logs/laravel.log');
        $command = "Get-Content -Path " . $file . " -Wait -Tail 10";
        $this->info("Tailing log file: {$file}");
        passthru("powershell.exe -Command \"$command\"");
    }
}
