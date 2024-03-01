<?php

namespace App\Services;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TaskService
{
    public function list(Request $request): Collection
    {
        $tasks = Task::query();

        $status = $request->status;
        $date = $request->date;

        if ($status) {
            $tasks->where('status', $status);
        }

        if ($date) {
            $tasks->whereDate('created_at', $date);
        }

        return $tasks->get();
    }

    public function store(StoreTaskRequest $request): Task
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return $task;
    }
    
    public function update(UpdateTaskRequest $request, Task $task): Task
    {
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}