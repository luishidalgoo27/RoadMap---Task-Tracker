<?php

namespace App\Console\Commands;

class CreateTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a task in database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $task = $this->taskService->store($name);

        $this->info("Task added successfully (ID: {$task->id})");

        return 0;
    }
}
