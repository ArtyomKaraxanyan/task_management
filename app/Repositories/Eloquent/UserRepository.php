<?php

namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Models\Workspace;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\WorkspaceInterface;

class UserRepository extends EloquentRepository implements UserInterface
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

}
