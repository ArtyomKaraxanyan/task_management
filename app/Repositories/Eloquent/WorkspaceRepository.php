<?php

namespace App\Repositories\Eloquent;


use App\Models\Workspace;
use App\Repositories\Interfaces\WorkspaceInterface;

class WorkspaceRepository extends EloquentRepository implements WorkspaceInterface
{
    /**
     * WorkspaceRepository constructor.
     * @param Workspace $workspace
     */
    public function __construct(Workspace $workspace)
    {
        $this->model = $workspace;
    }

}