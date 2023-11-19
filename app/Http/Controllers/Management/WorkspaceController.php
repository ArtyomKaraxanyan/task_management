<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workspace\StoreRequest;
use App\Http\Requests\Workspace\UpdateRequest;
use App\Models\Workspace;
use App\Models\WorkspaceAccess;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\WorkspaceRepository;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $workspace,$user;

    public function __construct(WorkspaceRepository $workspaceRepository,UserRepository $userRepository)
    {
       $this->workspace=$workspaceRepository;
       $this->user=$userRepository;
    }

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
        //
    }



    public function access(Workspace $workspace, Request $request)
    {
     if (isset($request->email)){
         $user=$this->user->findEmail($request->email);
         if ($user){
         WorkspaceAccess::updateOrCreate(['user_id'=>$user->id,'workspace_id'=>$workspace->id],['user_id'=>$user->id,'workspace_id'=>$workspace->id]);
         }else{
             $returnData = array(
                 'status' => 'error',
                 'message' => 'User Not Found!'
             );
           return response()->json($returnData,500);
         }
     }

    }

    public function accessDestroy(WorkspaceAccess $access)
    {
        try {
            $access->delete();
            return redirect('/');
        }catch (\Exception $exception){
        dd($exception->getMessage());
        return abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->workspace->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workspace=$this->workspace->findOrFail($id);
        $tasks= $workspace->tasks()->get();

        return view('task_management.workspace.index',['workspace'=>$workspace,'tasks'=>$tasks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Workspace $workspace)
    {
        $this->workspace->update($workspace,$request->all());

    }

    /**
     * @param Workspace $workspace
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Workspace $workspace)
    {
       $this->workspace->delete($workspace);
       return redirect('/');

    }
    public function border(Workspace $workspace)
    {
        $tasks = $workspace->tasks()->get();
        return view('task_management.workspace.index_border',['workspace'=>$workspace,'tasks'=>$tasks]);

    }
}
