<?php

namespace App\Console\Commands;

class UpdateTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update {id} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a task in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $name = $this->argument('name');
        
        $task = $this->taskService->update($id, $name);

        $this->info("Task updated successfully (ID: {$task->id})");

        return 0;
    }
}
