<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
class ForTestsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for test';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
    }
}
