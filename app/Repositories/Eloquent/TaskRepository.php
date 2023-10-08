<?php

namespace App\Repositories\Eloquent;


use App\Models\Task;
use App\Models\Workspace;
use App\Repositories\Interfaces\TaskInterface;
use App\Repositories\Interfaces\WorkspaceInterface;

class TaskRepository extends EloquentRepository implements TaskInterface
{
    /**
     * WorkspaceRepository constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

}