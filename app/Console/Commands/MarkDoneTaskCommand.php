<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MarkDoneTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark-done {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark done a task in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $task = $this->taskService->makedone($id);

        $this->info("Task mark done successfully (ID: {$task->id})");
    
        return 0;
    }
}
