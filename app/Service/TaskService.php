<?php

namespace App\Service;

use App\Http\Requests\TaskRequest;
use App\Models\Task;

class TaskService
{
    public function store(string $name): Task 
    {
        return Task::create(['name' => $name]);
    }

    public function update(int $id, string $name): Task
    {
        $task = Task::findOrFail($id);
        $task->update(['name' => $name]);
        return $task;
    }

    public function delete(int $id): Task
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return $task;
    }

    public function markinprogress(int $id): Task
    {
        $task = Task::find($id);
        $task->update(['status' => 'in-progress']);
        return $task;
    }

    public function makedone(int $id): Task
    {
        $task = Task::find($id);
        $task->update(['status' => 'done']);
        return $task;
    }

    public function list()
    {
        $tasks = Task::all()->pluck('name');
        return $tasks;
    }

    public function listdone()
    {
        $tasks = Task::where('status', 'done')->get()->pluck('name');
        return $tasks;
    }
    public function listtodo()
    {
        $tasks = Task::where('status', 'todo')->get()->pluck('name');
        return $tasks;
    }
    public function listinprogress()
    {
        $tasks = Task::where('status', 'in-progress')->get()->pluck('name');
        return $tasks;
    }
}
?>