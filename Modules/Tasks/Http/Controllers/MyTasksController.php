<?php

namespace Modules\Tasks\Http\Controllers;

use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendances\Entities\Attendance;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\TaskComment;
use Modules\Tasks\Traits\TaskTrait;
use Session;

class MyTasksController extends Controller
{
    use TaskTrait;

    /**
     * Holds User Value.
     *
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->project = Project::get();
            return $next($request);
        });
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function get()
    {
        $task = Task::where('assigned_to', $this->user->id)->where('status', '<>', 'F')->get();

        return $this->loadDatatable($task);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   
        return view('tasks::mytask.index');
    }

    /**
     * Called when someclick on taskstart buttton.
     *
     * @return Renderable
     */
    public function taskStart(Request $request)
    {
        $user = Auth::user()->id;

        $task = Task::where('id', $request->id)->first();

        $attendance = Attendance::whereDate('created_at', Carbon::today())->where('user_id', $this->user->id)->first();

        if(isset($attendance->logged_out)) {
            Session::flash('error',__('tasks::lang.you-have-been-logged-out'));
            return response()->json(['is_logged_in' => 0]);
        }
        if ($attendance) {
            $runningTask = Task::where('status', 'O')->where('assigned_to', $user)->first();

            if ($runningTask) {
                $this->runningTask($runningTask);
            }
            return $task->update(['status' => 'O', 'start_date_time' => getCurrenDateTime()]);
        } else {

            Session::flash('error', __('tasks::lang.not-logged-in'));
            return response()->json(['is_logged_in' => 0]);

        }
    }

    /**
     * Called when someclick on taskstop buttton.
     * @param Request $request
     * @return Renderable
     */
    public function taskStop(Request $request)
    {
        $user = Auth::user()->id;
        $task = Task::where('id', $request->id)->where('assigned_to', $user)->first();
        $this->runningTask($task);
    }

    /**
     * Called when someclick on finishtask buttton.
     * @param Request $request
     * @return Renderable
     */
    public function taskCompleted(Request $request)
    {
        $userId = Auth::user()->id;
        $attendance = Attendance::whereDate('created_at', Carbon::today())->where('user_id', $userId)->first();
        if(!isset($attendance->logged_in)) {
            Session::flash('error', __('tasks::lang.not-logged-in'));
            return response()->json(['is_logged_in' => 0]);
        } else if($attendance->logged_out) {
            Session::flash('error',__('tasks::lang.you-have-been-logged-out'));
            return response()->json(['is_logged_in' => 0]);
        } else {
            $task = Task::where('id', $request->id)->first();
            return $task->update(['status' => 'F', 'start_date_time' => getCurrenDateTime()]);

        }
        return true;
    }

    /**
     * Task details will be shown
     * @param $taskId taskid
     * @return Renderable
     */
    public function taskDetails($taskId)
    {
        $task = Task::where('id', $taskId)->first();

        $projects = Project::get();

        $users = User::where('role_id', '<>', '1')->get();

        return view('tasks::mytask.task-details', compact('task', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $data = $request->except('_token');
        TaskComment::create($data);

        return redirect()->route('task.mytasks')->with('success', __('tasks::lang.comment-successfully-added'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('tasks::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $taskId
     * @return Renderable
     */
    public function taskHistory($taskId)
    {
        $taskComment = TaskComment::where('task_id', $taskId)->orderby('id', 'desc')->get();

        return view('tasks::mytask.history', compact('taskComment'));
    }

    /**
     * Update Task history.
     * @param Request $request
     * @param int $id
     * @return boolean
     */
    public function updateTaskHistory(Request $request, $id)
    {
        $data = $request->all();
        $unserializeData = [];
        parse_str($data['data'], $unserializeData);
        $taskComment = TaskComment::find($id);
        $taskComment->update(['comment' => $unserializeData['comment']]);
        return true;

    }
    public function edit($id)
    {
        $projects = $this->project;
        $users = User::get();
        $task = Task::find($id);
        $priority = Auth::user()->role->priority;
        return view('tasks::edit', compact('task', 'projects', 'users', 'priority'));
    }
    /**
     * Show completed task list
     *
     * @return Renderable
     */
    public function completedTask()
    {
        
        $tasks = Task::where('assigned_to', $this->user->id)->where('status', 'F')->get(['tasks.id as tid','tasks.*']);
        return view('tasks::mytask.completed-task', compact('tasks'));
    }
     /**
     * Update the my task status
     * @param Request $request
     * @return Renderable
     */
    public function taskUpdateMyStatus(Request $request)
    {   
        $tid = $request->task_id;
        $task = Task::find($tid); 
        $task->update(['status' => $request->status]);
        return redirect()->to(route('task.completed.list'))->with('success',__('tasks::lang.successfully-updated'));
    }
}