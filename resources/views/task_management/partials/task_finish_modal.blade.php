
<!-- Template Main CSS File -->
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Finish Task</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('tasks.finish',$task->id)}}" id="modal-task-finish">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-duo_date" class="col-form-label">Task Finished:</label>
                        <input type="checkbox"  id="task_finished" name="task_finished"{{$task->task_finish_duration?"checked":''}} value="1">
                    </div>
                    <div class="form-group task_duration" @if(!$task->task_finish_duration) style="display: none" @endif >
                        <label for="recipient-duo_date" class="col-form-label">Task duration:</label>
                        @php($dateStart = new DateTimeImmutable($task->start_date))
                        @php($dateEnd = new DateTimeImmutable($task->end_date))
                        <input type="text" class="form-control" id="task_finish" name="task_range_finish" value="">
                        <input type="hidden" class="form-control" id="finish_start_date" name="finish_start_date" value="{{$task->start_date}}">
                        <input type="hidden" class="form-control" id="finish_end_date" name="finish_end_date" value="{{$task->end_date}}">
                        <input type="hidden" class="form-control" id="task_finish_duration" name="task_finish_duration" value="">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                        <button type="button" class="btn btn-success task-finish" >Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

<script>
    $(document).ready(function () {

        $('#task_finished').change(function() {
            if($(this).prop('checked')) {
                $(this).removeAttr("checked");
                $(".task_duration").show();
            } else {
                $(this).attr('checked');
                $(".task_duration").hide();
            }
        });

    })
        $(function() {
            $('input[name="task_range_finish"]').daterangepicker({
                opens: 'left',
                timePicker:true
            }, function(start, end, label) {
                $('#finish_start_date').val(start.format('YYYY-MM-DD HH:mm:ss'));
                $('#finish_end_date').val(end.format('YYYY-MM-DD HH:mm:ss'));

                var start_Task = moment($('#finish_start_date').val(), 'YYYY-MM-DD HH:mm:ss');
                var end_Task = moment($('#finish_end_date').val(), 'YYYY-MM-DD HH:mm:ss');


                var duration = moment.duration(end_Task.diff(start_Task));

                var days = Math.floor(duration.asDays());
                var hours = duration.hours();
                var minutes = duration.minutes();

                var formattedDuration = `${days}d ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;

                $('#task_finish_duration').val(formattedDuration);
            });

        });

</script>
