<?php

namespace Modules\Dashboard\Http\Controllers;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Attendances\Entities\Attendance;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\DailyWorkHour;
use Modules\Vacations\Entities\Vacation;
use Carbon\Carbon;
use App\Models\User;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return Renderable
     */
    public function index()
    {   
       
        $topEmployees = $this->TopEmployees();
       
        $employeeAttendance = Attendance::get();

        if (Auth::user()->role_id == 1) {
            return view('dashboard::admin.index',compact('topEmployees'));
        } else {
            $userId = Auth::user()->id;
           
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
            
            $allTask = $task->count();
            
            $finishedTask = $task->where('status','F')->count();
            
            $approvedLeaves = Vacation::where('user_id',$userId)->where('status','A')->count();

            return view('dashboard::user.index',compact('attendance','assignedProject','completedProject','dailyWorkHour','allTask','finishedTask','approvedLeaves','topEmployees','employeeAttendance'));
        }
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

    /**
     * Use for getting sorted top employee.
     * 
     * @return sorted value
     */
    public function TopEmployees()
    {
        $users = User::where('role_id','<>',1)->get();

        $topEmployees = [];

        foreach ($users as $key => $user) {
            $topEmployees[$key]['name'] = $user->name;
            $topEmployees[$key]['designation'] = $user->role->name;
            $topEmployees[$key]['workingHour'] = 
            DailyWorkHour::whereMonth('created_at', date('m'))->where('user_id',$user->id)->sum('duration');  
        }
        
        usort($topEmployees, array( $this, 'sortWorkingHour' ));

        return $topEmployees;
    }
     /**
     * Use for getting employee attendance.
     * 
     * @return sorted value
     */
    public function employeesAttendance()
    {   

        $userID = Session::get('user_id');

        $user = Auth::user();
        
        $employeeAttendance = Attendance::whereMonth('created_at', date('m'))->orderBy('id', 'DESC')->where('user_id', $userID)->get();

        if($user->role_id != 1) {
            $employeeAttendance = Attendance::whereMonth('created_at', date('m'))->orderBy('id', 'DESC')->where('user_id', $user->id)->get();
        }

        return Datatables::of($employeeAttendance)
            ->addIndexColumn()
            ->addColumn('user_id', function ($row) {
                return ($row->user_id);
            })
            ->addColumn('name', function ($row) {
                return ($row->user->name);
            })
            ->addColumn('created_at', function ($row) {
                return formatDate($row->created_at);
            })
            ->addColumn('logged_in', function ($row) {
                if (isset($row->logged_in)) {
                return formatDateTime($row->logged_in);
                } else {
                    return __('dashboard::lang.not-logged-out');
                }
            })
            ->addColumn('logged_out', function ($row) {
                if (isset($row->logged_out)) {
                    return formatDateTime($row->logged_out);
                } else {
                    return __('dashboard::lang.not-logged-out');
                }

            })
            ->addColumn('workingHour', function ($row) {
                if (isset($row->dailyHour->duration)) {
                    return ($row->dailyHour->duration);
                }else{
                    return __('dashboard::lang.not-available');
                }
            })
            ->addColumn('totalhours', function ($row) {

                if (isset($row->logged_out)) {
                    $hours = getTimeDifference($row->logged_out,$row->logged_in);
                } else {
                    $hours = __('dashboard::lang.not-available');
                }

                return $hours;
            })
            ->rawColumns(['totalhours'])
            ->make(true);
    }
}   