
<!-- Template Main CSS File -->
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Update Task</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('tasks.update',$task->id)}}" id="modal-details-edit">
                    @method('PUT')
                    @csrf
                    <input type="hidden" value="{{$workspace->id}}" name="workspace">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$task->name}}">
                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" >{{$task->description}}</textarea>
                    </div>

                    <div class="form-group form-group-select ">
                        <select class="select2-edit" id="select_status" name="status">
                            <option value="">---</option>
                            @forelse(\App\Enums\TaskDetailsEnum::statuses() as $status)
                                <option value="{{$status->id}}"{{$task->status==$status->id?'selected':''}}>{{ucfirst($status->name)}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group form-group-select ">
                        <select class="select2-edit" id="select_priority" name="priority">
                            <option value="">---</option>
                            @forelse(\App\Enums\TaskDetailsEnum::priorities() as $priority)
                                <option value="{{$priority->id}}"{{$task->priority==$priority->id?'selected':''}}>{{$priority->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-project" class="col-form-label">Project:</label>
                        <input type="text" class="form-control" id="project" name="project" value="{{$task->project}}">

                    </div>

                    <div class="form-group">
                        <label for="recipient-duo_date" class="col-form-label">Task duration:</label>
                        @php($dateStart = new DateTimeImmutable($task->start_date))
                        @php($dateEnd = new DateTimeImmutable($task->end_date))
                        <input type="text" class="form-control" id="task_range" name="task_range_edit" value="{{str_replace('-','/',$dateStart->format('m-d-Y H:i:s')).' - '.str_replace('-','/',$dateEnd->format('m-d-Y H:i:s'))}}">
                        <input type="hidden" class="form-control" id="task_start_date_edit" name="start_date" value="{{$task->start_date}}">
                        <input type="hidden" class="form-control" id="task_end_date_edit" name="end_date" value="{{$task->end_date}}">
                        <input type="hidden" class="form-control" id="task_duration_edit" name="task_duration" value="{{$task->task_duration}}">
                        <input type="hidden" name="timezone" id="timezone">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                        <button type="button" class="btn btn-success task-edit" >Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

<script>
        $(function() {
            $('input[name="task_range_edit"]').daterangepicker({
                drops: 'up',
                opens: 'left',
                timePicker:true
            }, function(start, end, label) {
                $('#task_start_date_edit').val(start.format('YYYY-MM-DD HH:mm:ss'));
                $('#task_end_date_edit').val(end.format('YYYY-MM-DD HH:mm:ss'));

                var start_Task = moment($('#task_start_date_edit').val(), 'YYYY-MM-DD HH:mm:ss');
                var end_Task = moment($('#task_end_date_edit').val(), 'YYYY-MM-DD HH:mm:ss');


                var duration = moment.duration(end_Task.diff(start_Task));

                var days = Math.floor(duration.asDays());
                var hours = duration.hours();
                var minutes = duration.minutes();

                var formattedDuration = `${days}d ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;

                $('#task_duration_edit').val(formattedDuration);
            });

        });

</script>
