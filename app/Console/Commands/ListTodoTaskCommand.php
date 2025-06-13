<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListTodoTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list-todo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List todo tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $task = $this->taskService->listtodo();

        $this->info("List of todo tasks: {$task}");
    }
}
