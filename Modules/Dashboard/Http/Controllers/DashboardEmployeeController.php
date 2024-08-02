<?php

namespace Modules\Dashboard\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Attendances\Entities\Attendance;
use Modules\Projects\Entities\Project;
use Illuminate\Http\Request;
use Modules\Employees\Entities\Employee;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\DailyWorkHour;
use Modules\Vacations\Entities\Vacation;
use Carbon\Carbon;
use App\Models\User;
use Session;

class DashboardEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return Renderable
     */
    public function index($userId)
    {
        $username = User::where('id',$userId)->pluck('name')->first();
        
        Session::put('user_id', $userId);

        $attendance = Attendance::whereMonth('created_at', date('m'))->where('user_id', $userId)->whereYear('created_at', date('Y'))->count();

        $finishedProjects = Project::where('status','F')->get(['id'])->toArray();
        
        $groupCompletedProject = [];
        $finishProject = [];
        $finishedProject = [];
        foreach($finishedProjects as $key => $finishedProject) {
            $finishProject[$key] = $finishedProject['id'];
        }
        $groupCompletedProject = Task::whereIn('project_id', $finishedProject)->where('assigned_to',$userId)->get();

        $completedProject = $groupCompletedProject->groupBy('project_id')->count();

        $assignedProject = Task::groupBy('project_id')->where('assigned_to',$userId)->count();

        $dailyWorkHour = DailyWorkHour::whereMonth('created_at', date('m'))->where('user_id',$userId)->sum('duration');

        $task = Task::where('user_id',$userId)->get();
        
        $finishedTask = $task->where('status','F')->count();
        
        $approvedLeaves = Vacation::where('user_id',$userId)->where('status','A')->count();

        return view('dashboard::employee.index',compact('attendance','completedProject','finishedProjects','finishedTask','approvedLeaves','dailyWorkHour','task','username'));
    } 
        /**
     * Display a listing of the resource.
     * @param array $a, $b
     * @return sorted value
     */
    public function sortWorkingHour($a, $b) 
    {
        if ($a['workingHour'] == strtotime($b['workingHour'])) return 0;
        return ($a['workingHour'] > $b['workingHour']) ?-1:1;
    }
 
}
