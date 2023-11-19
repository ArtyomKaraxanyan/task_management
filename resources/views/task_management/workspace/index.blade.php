@extends('task_management.layouts.app')
@section('content')
    <div class="pagetitle">
        <div>
        <h1 style="text-align: left">Workspace</h1>
            <a href="{{route('workspaces.border',$workspace->id)}}"><h5 style="text-align:right">Border</h5></a>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'/'}}">Home</a></li>
                <li class="breadcrumb-item active">{{$workspace->name}}</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card">
                    <div  class="card-body">
                        <div id="block_container">
                        <div>
                            <h5 class="card-title">{{$workspace->name}} Tasks List</h5>
                        </div>
                        </div>
                        <h5 class="card-title">
                            <button type="button"
                                    class="btn btn-sm btn-outline-success text-capitalize create-task "
                                    data-bs-toggle="modal" data-bs-target="#createTask">
                                + Create
                            </button>
                        </h5>
                        <div class="table-responsive" id="data-list">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Key</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Task Duration</th>
                                    {{--<th scope="col">Start</th>--}}
                                    {{--<th scope="col">End</th>--}}
                                    <th scope="col">Task Ended </th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $task->id }}</th>
                                        <td scope="row">{{ $task->name }}</td>
                                        <td scope="row">{{ $task->user()->name}}</td>
                                        <th scope="row" style="{{$task->taskStatus()&&$task->taskStatus()->id==5? 'color:green':''}}">{{ $task->taskStatus()?$task->taskStatus()->name:'' }}</th>
                                        <th scope="row">{{ $task->taskPriority()?$task->taskPriority()->name :''}}</th>
                                        <th scope="row">{{ $task->project }}</th>
                                        <th scope="row">{{ $task->task_duration }}</th>
                                        {{--<th scope="row">{{ $task->start_date }}</th>--}}
                                        {{--<th scope="row">{{ $task->end_date }}</th>--}}
                                        <th scope="row">
                                            @if($task->task_finish_duration)
                                                <span style="color: green;"> {{$task->task_finish_duration}}</span>
                                            @else
                                                Empty
                                            @endif
                                        </th>
                                        <td>
                                            <a href="{{route('tasks.edit',$task->id)}}"
                                               title="{{ __('Edit') }}"
                                               type="button"
                                               class="btn btn-sm btn-outline-primary edit-task"
                                               data-bs-target="#editTask">
                                                <i class="bi bi-pencil-square "></i>
                                            </a>
                                            <form method="post" action="" class="d-inline-block delete_item">
                                                @method('DELETE')
                                                @csrf
                                                <a type="button"
                                                   class="btn btn-sm btn-outline-danger delete btn-delete delete-item"
                                                   data-url="{{ route('tasks.destroy', $task->id) }}"
                                                   title="{{ __('Delete') }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </form>
                                            <a type="button"
                                               class="btn btn-sm btn-outline-info task_show"
                                               data-url="{{ route('tasks.show', $task->id) }}"
                                               title="{{ __('Task Info') }}" data-bs-target="#taskShow">
                                                <i class="bi bi-info-circle"></i>
                                            </a>
                                            @if($task->taskStatus()&&$task->taskStatus()->id==5)
                                                <a type="button"
                                                   class="btn btn-sm btn-outline-success add_end_time"
                                                   data-url="{{ route('tasks.finish.show', $task->id) }}"
                                                   title="{{ __('Add End Time') }}" data-bs-target="#taskFinish">
                                                    <i class="bi bi-clock"></i>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td class="text-center" colspan="10">
                                            Empty data
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('task_management.partials.modals')
        @if(isset($task))
        <div class="modal modal-edit fade" id="editTask" role="dialog"  aria-hidden="true">
            @include('task_management.partials.task_edit_modal')
        </div>
         <div class="modal modal-finish fade" id="finishTask" role="dialog"  aria-hidden="true">
            @include('task_management.partials.task_finish_modal')
        </div>
            <div class="modal modal-info fade" id="infoTask" role="dialog"  aria-hidden="true">
            @include('task_management.partials.task_finish_modal')
        </div>
         @endif
    </section>
    <script>
        $(document).on('click', '.task-save', function () {
            $('#modal-details').submit();
        })

        $(document).on('click', '.task-edit', function () {
            $('#modal-details-edit').submit();
        })
        $(document).on('click', '.task-finish', function () {
            $('#modal-task-finish').submit();
        })
    </script>
@endsection
