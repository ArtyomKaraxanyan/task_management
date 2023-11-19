<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{'/'}}">
                <i class="bi bi-grid"></i>
                <span>Manage</span>
            </a>

        </li>
        <a href="{{ route('workspaces.store') }}" class="btn btn-sm btn-outline-success text-capitalize create_workspace" data-user_id="{{Auth::id()}}">
            + Create Workspace
        </a>
        </ul>

    <ul id="sortable" class="sidebar-nav" >
    @forelse(\App\Enums\WorkspaceEnum::workspaces() as $workspace)
        <li class="nav-item">
            <div class="justify-content-between d-flex sidebar-drop">
            <a class="nav-link " href="{{route('workspaces.show',$workspace->id)}}">
                <i class="bi bi-menu-button-wide"></i><span class="{{request()->segment(1) == strtolower($workspace) ? '' : '' }}">{{$workspace->name}}</span>
            </a>

            <a class=" dropdown-action dropdown-toggle action-workspace " data-name="{{$workspace->name}}" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots ms-auto action_workspace"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a href="{{ route('workspaces.update', $workspace->id) }}"
                         title="{{ __('Edit') }}"
                         type="button"
                         class="btn btn-sm btn-outline-primary action-workspace-edit" data-name="{{ $workspace->name}}">
                         Edit  <i class="bi bi-pencil-square"></i>
                    </a>
                </li>
                <li>
                    <form method="post" action="" class="d-inline-block delete_item">
                        @method('DELETE')
                        @csrf
                        <a type="button" class="btn btn-sm btn-outline-danger delete btn-delete delete-item action-workspace-delete"
                           data-url="{{ route('workspaces.destroy', $workspace->id) }}"
                           title="{{ __('Delete') }}">
                           Delete <i class="bi bi-trash"></i>
                        </a>
                    </form></li>

                <li>
                        <a type="button" class="btn btn-sm btn-outline-success  btn-access access-item action-workspace-access"
                           href="{{ route('workspaces.access', $workspace->id) }}"
                           title="{{ __('Access') }}">
                            Access <i class="bi bi-person-plus"></i>
                        </a>
                </li>

            </ul>
            </div>
        </li>
        @empty
        @endforelse
    </ul>
@if(\App\Enums\WorkspaceEnum::accessWorkspaces() && count(\App\Enums\WorkspaceEnum::accessWorkspaces())>0)
    <ul class="sidebar-nav " id="sidebar-nav">
        <li class="nav-item ">
            <a class="nav-link justify-content-center " href="{{'/'}}">
                <i class="bi bi-grid"></i>
                <span>Access</span>
            </a>
        </li>
    @forelse(\App\Enums\WorkspaceEnum::accessWorkspaces() as $access)
        <li class="nav-item">
            <div class="justify-content-between d-flex sidebar-drop">
            <a class="nav-link " href="{{route('workspaces.show',$access->id)}}">
                <i class="bi bi-menu-button-wide"></i><span class="{{request()->segment(1) == strtolower($access) ? '' : '' }}">{{$access->name}}</span>
            </a>
                <a class=" dropdown-action dropdown-toggle action-workspace " data-name="{{$workspace->name}}" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots ms-auto action_workspace"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <li>
                        <form method="post" action="" class="d-inline-block delete_item">
                            @method('DELETE')
                            @csrf
                            <a type="button" class="btn btn-sm btn-outline-danger delete btn-delete delete-item action-workspace-delete"
                               data-url="{{ route('workspaces.destroy_access', \App\Enums\WorkspaceEnum::access($access->id)) }}"
                               title="{{ __('Delete Access') }}">
                                Delete Access<i class="bi bi-trash"></i>
                            </a>
                        </form></li>
                </ul>
            </div>
        </li>
        @empty
        @endforelse
    </ul>
    @endif

</aside>

<script>
    $( function() {
        $( "#sortable" ).sortable();
    } );
</script>

