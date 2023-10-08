<?php

namespace App\Enums;

use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;

class WorkspaceEnum
{

    public static function workspaces()
    {
        $user=Auth::user();
        return $user->workspaces()->get();
    }
 public static function accessWorkspaces()
    {
        $user=Auth::user();
        $workspaceAcceses=$user->accessWorkspaces()->get();
        $workspaceIds = $workspaceAcceses->pluck('workspace_id')->unique();

        $workspaces = Workspace::whereIn('id', $workspaceIds)->get();
        return $workspaces;

    }
    public static function access($access)
    {
        $user=Auth::user();
        $workspaceAcceses=$user->accessWorkspaces()->where('workspace_id',$access)->first();
        return $workspaceAcceses->id;

    }


}
