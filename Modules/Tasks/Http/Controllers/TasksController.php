<?php

namespace Modules\Tasks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use App\Models\User;
use Auth;
use Session;
use Modules\Tasks\Entities\TaskComment;
use DataTables;
use Modules\Tasks\Traits\TaskTrait;

class TasksController extends Controller
{    
    use TaskTrait;   
    /**
     * holds project model value.
     * 
     */
    protected $project;
    
    /**
     * holds user model value.
     * 
     */
     protected $user;

     /**
     * Initited on the class call
     * 
     */
    public function __construct()
    {
        $this->project = Project::get();
        $this->user = User::where('role_id','<>','1')->get(); 
    }

    /**
     * Send data to datatable.
     * @return response
     */
    public function getTaskdata()
    {   
        $priority = Auth::user()->role->priority;

        $task = Task::Join('users', 'tasks.user_id', '=', 'users.id')
                ->Join('roles','users.role_id','roles.id')
                ->where('roles.priority','>=',$priority)
                ->where('status','!=','F')
                ->get(['tasks.id as tid','tasks.*']);
        return $this->loadTask($task);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {  
        $tasks = Task::where('user_id',Auth::user()->id)->get();
        return view('tasks::index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {   
        $projects = $this->project; 
        $users = $this->user;
        $priority = Auth::user()->role->priority;
        return view('tasks::create',compact('projects','users','priority'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {   
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $data['title'] = strip_tags($request->title);
        Task::create($data);
        return redirect()->to(route('admin.tasks'))->with('success',__('tasks::lang.successfully-created'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {   
        $projects = $this->project;
        $task = Task::find($id);
        return view('tasks::show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {   
        $projects = $this->project; 
        $users = $this->user;
        $task = Task::find($id);
        $priority = Auth::user()->role->priority;
        return view('tasks::edit',compact('task','projects','users','priority'));
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->update($request->all());
        return redirect()->to(route('admin.tasks'))->with('success',__('tasks::lang.successfully-updated'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Boolean
     */
    public function destroy($id)
    {   
        $isRunnig = Task::where('id',$id)->where('status','O')->first();
        
        if($isRunnig) {
            $false = 0;
            Session::flash('error',__('tasks::lang.task-is-running'));
            return $false;
        } 
        
        Task::destroy($id);
        Session::flash('success',__('tasks::lang.successfully-deleted'));
        return true;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function viewTaskHistory($taskId)
    {   
       $taskComment = TaskComment::where('task_id',$taskId)->get();
       return view('tasks::task-history',compact('taskComment'));
    }

    /**
     * Get Completed task based on 
     * 
     * @return Renderable
     */
    public function CompletedTask()
    {
        $roleId = Auth::user()->role->id;

        $tasks = Task::leftJoin('users', 'tasks.user_id', '=', 'users.id')
                ->where('users.role_id','>=',$roleId)
                ->where('status','F')
                ->get(['tasks.id as tid','tasks.*']);

        return view('tasks::completed-task',compact('tasks'));
    }
    
    /**
     * Update the task status
     * @param Request $request
     * @return Renderable
     */
    public function taskUpdateStatus(Request $request)
    {   
        $tid = $request->task_id;
        $task = Task::find($tid); 
        $task->update(['status' => $request->status]);
        return redirect()->to(route('admin.completed.task'))->with('success',__('tasks::lang.successfully-updated'));
    }
}