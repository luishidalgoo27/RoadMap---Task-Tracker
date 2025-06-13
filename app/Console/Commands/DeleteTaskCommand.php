<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a task in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $task = $this->taskService->delete($id);

        $this->info("Task deleted successfully (ID: {$task->id})");
        return 0;
    }
}
