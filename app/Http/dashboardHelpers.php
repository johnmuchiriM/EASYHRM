<?php 


//get total employees
function totalEmployee()
{
    $empObj = new \Modules\Employees\Entities\Employee;

    return $empObj->count();
}

//get total projects
function totalProjects()
{
    $projObj = new \Modules\Projects\Entities\Project;

    return $projObj->count();
}

//top 5 employees
function top5EmpAccordingToTasks()
{
    $taskObj = new \Modules\Tasks\Entities\Task;

    $task = $taskObj->distinct('assigned_to')->limit(5)->cursor();

    return $task;
}



/**
 * get EmpTotal Worked Hours per months
 * 
 */
function taskHourPerMonth($empId = '')
{
    $taskObj = new \Modules\Tasks\Entities\Task;

    $totalWorkedHours = $taskObj->where('assigned_to', $empId)->sum('duration');
    
    return $totalWorkedHours;

}

//get all tasks count
function allTasksCount()
{
    $taskObj = new \Modules\Tasks\Entities\Task;

    $alltasksCount  = $taskObj->cursor()->count();

    return $alltasksCount;
}

//get task count which status is ongoing
function onGoingTasksCount()
{
    $taskObj = new \Modules\Tasks\Entities\Task;

    $onGoingTaskCount = $taskObj->where('status', 'O')->count();

    return $onGoingTaskCount;
}

//get task count which status is stopped
function stoppedTasksCount()
{
    $taskObj = new \Modules\Tasks\Entities\Task;

    $stoppedTaskCount = $taskObj->where('status', 'S')->cursor()->count();

    return $stoppedTaskCount;
}

//get task count which status is finished
function finishedTasksCount()
{
    $taskObj = new \Modules\Tasks\Entities\Task;

    $finishedTaskCount = $taskObj->where('status', 'F')->cursor()->count();

    return $finishedTaskCount;
}

//get all employee
function getAllEmp()
{
    $userObj = new \App\Models\User;

    $users = $userObj->where('role_id', '<>', 1)->with('role')->cursor();

    return $users;
}

//emp on leaves
function empOnLeaves()
{
    $vacationObj = new \Modules\Vacations\Entities\Vacation;
    
    $users = $vacationObj->cursor();

    return $users;
}

//Emp on leave count
function empOnLeavesCount()
{
    $attendanceObj = new \Modules\Attendances\Entities\Attendance;

    $users = $attendanceObj->whereDate('created_at','=',\Carbon\Carbon::today())->count();
   
    return $users;
}

//All worked hours monthly based
function monthlyWorkedHours()
{
    $taskObj = new \Modules\Tasks\Entities\Task;

    $monthlyWorkedHours =  $taskObj->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('duration');

    return round($monthlyWorkedHours);
}
