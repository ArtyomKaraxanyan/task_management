<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Repositories\Eloquent\TaskRepository;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    protected $task;
    public function __construct(TaskRepository $taskRepository)
    {
        $this->task=$taskRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(StoreRequest $request)
      {
        $newTask=$request->all();
          $newTask['user_id']=Auth::id();
        $this->task->create($newTask);
       return redirect()->back()->withSuccess('Created');
      }

    /**
     * @param Task $task
     */
    public function show(Task $task)
    {
        $workspace=$task->workspace();
        return view('task_management.partials.task_info_modal',['task'=>$task,'workspace'=>$workspace])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $workspace=$task->workspace();
        return view('task_management.partials.task_edit_modal',['task'=>$task,'workspace'=>$workspace])->render();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Task $task)
    {
        $taskUpdate=$request->all();
         if ($taskUpdate['status'] && $taskUpdate['status']!=5){
             $taskUpdate['task_finish_duration']=null;
             $taskUpdate['finish_start_date']=null;
             $taskUpdate['finish_end_date']=null;
         }
        $this->task->update($task,$taskUpdate);
        return redirect()->back()->withSuccess('Updated');
    }

    public function taskFinishShow(Task $task)
    {
        return view('task_management.partials.task_finish_modal',['task'=>$task])->render();
    }

    public function taskFinish(Request $request, Task $task)
    {
        $taskFinish=array_slice($request->all(), -3);
        if (isset($request->task_finished)) {
            if (is_null($taskFinish['task_finish_duration'])) {
                $taskFinish['task_finish_duration']=$task->task_finish_duration;
            }
        } else {
            $taskFinish['task_finish_duration'] = null;
        }

        $this->task->update($task,$taskFinish);
        return redirect()->back()->withSuccess('Updated Task finish');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->task->delete($task);
        return redirect()->back()->withSuccess('Deleted');

    }

    /**
     * @param Request $request
     * @return void
     */
    public function taskSort(Request $request)
    {
        if ($request->to!=5){
           $taskFinish = null;
            $this->task->find($request->item)->update(['status'=>$request->to,'task_finish_duration'=>$taskFinish]);

       }else{
            $this->task->find($request->item)->update(['status'=>$request->to]);

        }

    }
}
