<style>


    #task-info-paper {
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, white 29px, #00b0d7 1px);
        background-size: 100% 30px;
        position: relative;
        overflow: hidden;
        border-radius: 5px;
    }

    #content {
        margin-top:88px;
        font-size:20px;
        line-height:30px;

    }
    #content p{
        margin:-100px 0 30px 0;


    }
</style>
<!-- Template Main CSS File -->
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task Info</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <header class="text-center">
                <h1>{{$task->name}}</h1>
            </header>
            <div class="modal-body" id="task-info-paper">

                    <div id="content">
                        <div class="hipsum">
                            <p>{{$task->description}}</p>
                        </div>
                    </div>


        </div>
            <div class="text-center">
                <p>Project: {{$task->project}}</p>
                <p>Start Date: {{$task->start_date}}</p>
                <p>End Date: {{$task->end_date}}</p>
                <p>Task Duration: {{$task->task_duration}}</p>
                @if($task->task_finish_duration)
                <p>Finish Duration: {{$task->task_finish_duration}}</p>
                <p> Finish Start Date: {{$task->finish_start_date}}</p>
                <p>Finish End Date: {{$task->finish_end_date}}</p>
                @endif
            </div>

    </div>
    </div>
