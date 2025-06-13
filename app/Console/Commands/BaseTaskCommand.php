<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service\TaskService;

abstract class BaseTaskCommand extends Command
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        parent::__construct();
        $this->taskService = $taskService;
    }

    
}
