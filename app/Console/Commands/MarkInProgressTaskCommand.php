<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MarkInProgressTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark-in-progress {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark in progress a task in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $task = $this->taskService->markinprogress($id);

        $this->info("Task mark in progress succesfully (ID: {$task->id})");
        
        return 0;
    }
}
