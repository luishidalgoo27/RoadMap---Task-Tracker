<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all tasks of database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $task = $this->taskService->list();
        
        $this->info("List of tasks: {$task}");

        return 0;
    }
}
