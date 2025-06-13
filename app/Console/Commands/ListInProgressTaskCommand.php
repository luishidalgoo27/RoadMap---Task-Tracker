<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListInProgressTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list-in-progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List in progress tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $task = $this->taskService->listinprogress();

        $this->info("List of in progress tasks: {$task}");
    }
}
