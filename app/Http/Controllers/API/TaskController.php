<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Exception;

class TaskController extends BaseController
{
    private $taskService;

    public function __construct(TaskService $service)
    {
        $this->taskService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskService->list();

        return $this->successResponse($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $task = $this->taskService->store($request);

            return $this->successResponse($task, 'Task created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $this->successResponse($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $task = $this->taskService->update($request, $task);

            return $this->successResponse($task, 'Task updated successfully');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->taskService->delete($task);

        return $this->successResponse(null, 'task deleted successfully');
    }
}
