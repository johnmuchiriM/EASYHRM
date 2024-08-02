<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use Session;
use Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   
        $priority = Auth::user()->role->priority;
      
        $projects = Project::leftJoin('users', 'projects.user_id', '=', 'users.id')
                ->Join('roles','users.role_id','roles.id')
                ->where('roles.priority','>=',$priority)
                ->where('status','<>','F')
                ->get(['projects.id as pid','projects.*']);
      return view('projects::index',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {   
        $data = $request->except('_token','project_id');
        
        $data['user_id'] = Auth::user()->id;
        $data['title'] = strip_tags($request->title);
        $data['specification'] = strip_tags($request->specification);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'specification' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'deadline' => 'required|date|after:start_date',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($request->project_id != null) {
            
            Project::where('id', $request->project_id)->update($data);
            Session::flash('success', __('projects::project.successfully-updated'));

        } else {

            Project::create($data);
            Session::flash('success', __('projects::project.successfully-created'));
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('projects::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {   
        return  Project::find($id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {   
        $task = Task::where('project_id',$id)->first();
        $false = 0;

        if($task) {
            Session::flash('error',__('projects::project.in-use'));
            return $false;
        }

        Project::destroy($id);
        Session::flash('success',__('projects::project.successfully-deleted'));
        return true;
    }

    /**
     * Show all completed project based on role
     * 
     * @return Renderable
     */
    public function completedProject()
    {   
        $roleId = Auth::user()->role->id;
        
        $projects = Project::leftJoin('users', 'projects.user_id', '=', 'users.id')
                ->where('users.role_id','>=',$roleId)
                ->where('status','F')
                ->get(['projects.id as pid','projects.*']);
        return view('projects::completed-project',compact('projects'));        
    }
     /**
     * Update the project status
     * @param Request $request
     * @return Renderable
     */
    public function updateProjectStatus(Request $request)
    {   
        $pid = $request->project_id;
        $project = Project::find($pid); 
        $project->update(['status' => $request->status]);
        return redirect()->to(route('admin.completed.project'))->with('success',__('projects::project.completed-project-successfully-updated'));
    }
}
