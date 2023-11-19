@extends('task_management.layouts.app')
@section('content')
    <div class="pagetitle">
        <div>
            <h1 style="text-align: left">Workspace</h1>
            <a href="{{route('workspaces.show',$workspace->id)}}"><h5 style="text-align:right">List</h5></a>
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
                        <div class="table-responsive sort-task"  data-url="{{route('tasks.sort')}}" id="data-list">
                            <div class="row row-tasks">
                               @foreach(\App\Enums\TaskDetailsEnum::statuses() as $status)
                                   <div class="col-md-4">
                                       <div class="card card-border">
                                           <div class="text-center">
                                               <div class="card-header">
                                                   <h4><b>{{ucfirst($status->name)}}</b></h4>
                                               </div>
                                           </div>
                                               <ul id="{{str_replace(' ', '', $status->name)}}" data-id="{{$status->id}}" class="task-border-ul">
                                               @foreach($status->tasksQuery($workspace->id) as $task)
                                                       <li class="task-border-li" data-id="{{$task->id}}">
                                                       <div class="card-body border-task-body" >
                                                           <div>
                                                       <p>{{$task->name }}
                                                       </p>
                                                           </div>
                                                           <div>

                                                           <a type="button"
                                                              class="btn btn-sm btn-outline-info task_show"
                                                              data-url="{{ route('tasks.show', $task->id) }}"
                                                              title="{{ __('Task Info') }}" data-bs-target="#taskShow">
                                                               <i class="bi bi-info-circle"></i>
                                                           </a>
                                                               <a type="button" @if($task->taskStatus()&&$task->taskStatus()->id!=5)style="display: none" @endif class="btn btn-sm btn-outline-success add_end_time"
                                                                  data-url="{{ route('tasks.finish.show', $task->id) }}"
                                                                  title="{{ __('Add End Time') }}" data-bs-target="#taskFinish">
                                                                   <i class="bi bi-clock"></i>
                                                               </a>
                                                               </div>
                                                       </div>
                                                       </li>
                                               @endforeach
                                               </ul>
                                       </div>
                                   </div>
                               @endforeach
                            </div>
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
        function sortableAjax(evt) {
            var itemEl = evt.item;
            evt.to;
            evt.from;
            let to= evt.to.getAttribute("data-id")
            let from= evt.from.getAttribute("data-id")
            let item= evt.item.getAttribute("data-id")
            let url =$('.sort-task').data('url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "POST",
                data: {to:to,from:from,item:item},
            });
     if(to==5){
      itemEl.querySelector('.add_end_time').style.display = "inline";
    }else{
         itemEl.querySelector('.add_end_time').style.display = "none";

     }
        }
        new Sortable(todo, {
            group: 'shared',
            animation: 150,
            onEnd: function (evt) {
                sortableAjax(evt)
            },


        });

        new Sortable(inprogress, {
            group: 'shared',
            animation: 150,
            onEnd: function (evt) {
                sortableAjax(evt)

            },
        });
        new Sortable(pending, {
            group: 'shared',
            animation: 150,
            onEnd: function (evt) {
                sortableAjax(evt)


            },
        });
        new Sortable(testing, {
            group: 'shared',
            animation: 150,
            onEnd: function (evt) {
                sortableAjax(evt)


            },
        });
        new Sortable(done, {
            group: 'shared',
            animation: 150,
            onEnd: function (evt) {
                sortableAjax(evt)

            },
        });

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
