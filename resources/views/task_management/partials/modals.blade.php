<div class="modal modal-create  fade" id="createTask" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >New Task</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('tasks.store')}}" id="modal-details">
                    @csrf
                    <input type="hidden" value="{{$workspace->id}}" name="workspace">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">

                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" >@if(old('description')){{old('description')}}@endif</textarea>
                    </div>

                    <div class="form-group form-group-select ">
                        <select class="select2" id="select_status" name="status">
                            <option value="">---</option>
                            @forelse(\App\Enums\TaskDetailsEnum::statuses() as $status)
                            <option value="{{$status->id}}"{{old('status')==$status->id?'selected':''}}>{{ucfirst($status->name)}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group form-group-select ">
                        <select class="select2" id="select_priority" name="priority">
                            <option value="">---</option>
                            @forelse(\App\Enums\TaskDetailsEnum::priorities() as $priority)
                            <option value="{{$priority->id}}"{{old('priority')==$priority->id?'selected':''}}>{{$priority->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-project" class="col-form-label">Project:</label>
                        <input type="text" class="form-control" id="project" name="project" value="{{old('project')}}">

                    </div>

                    <div class="form-group">
                        <label for="recipient-duo_date" class="col-form-label">Task duration:</label>
                        @php($dateStart = new DateTimeImmutable(old('start_date')))
                        @php($dateEnd = new DateTimeImmutable(old('end_date')))
                        <input type="text" class="form-control" id="task_range" name="task_range" value="{{str_replace('-','/',$dateStart->format('m-d-Y H:i:s')).' - '.str_replace('-','/',$dateEnd->format('m-d-Y H:i:s'))}}">
                        <input type="hidden" class="form-control" id="task_start_date" name="start_date" value="{{old('start_date')}}">
                        <input type="hidden" class="form-control" id="task_end_date" name="end_date" value="{{old('end_date')}}">
                        <input type="hidden" class="form-control" id="task_duration" name="task_duration" value="{{old('task_duration')}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                        <button type="button" class="btn btn-success task-save" >Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
