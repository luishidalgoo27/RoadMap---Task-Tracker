<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListDoneTaskCommand extends BaseTaskCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list-done';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List done tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $task = $this->taskService->listdone();

        $this->info("List of done tasks: {$task}");
    }
}
