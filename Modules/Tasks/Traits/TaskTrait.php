<?php
namespace Modules\Tasks\Traits;

use Modules\Tasks\Entities\DailyWorkHour;
use Modules\Attendances\Entities\Attendance;
use DataTables;
use Auth;
use Carbon\Carbon;

/**
 * this trait is use to manage task data
 */
trait TaskTrait
{
    /**
     * Send data to datatable.
     * @param $task
     * @return Response
     */
    public function loadDatatable($task)
    {
        return Datatables::of($task)
            ->addIndexColumn()
            ->addColumn('title', function ($row) {
                $title = '<a href=' . route('task.details', $row->id) . '>' . $row->title . '</a>';
                return $title;
            })
            ->addColumn('project-title', function ($row) {
                return $row->project->title;
            })
            ->addColumn('duration', function ($row) {
                return $row->duration;
            })
            ->addColumn('taskstatus', function ($row) {
                if ($row->status == 'O') {
                    $button = '<a href=javascript:void(0)" class="start-task btn btn-primary">On Going</a>';
                } elseif (($row->status != 'O')&&($row->status == 'S')&&($row->status == 'F')) {
                    $button = '<a href="javascript:void(0)" class="start-task btn btn-success">Finished</a>';
                } else {
                    $button = '<a href="javascript:void(0)" class="start-task btn btn-danger">Stopped</a>';
                }
                return $button;
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                if ($row->status == 'O') {
                    $btn = '<a href="javascript:void(0)" id=' . $row->id . ' title="Stop Task"  class="stop-task btn btn-danger mr-2">
                    <i class="fa fa-stop" aria-hidden="true"></i>
                    </a>';
                }
                if ($row->status == 'S' || $row->status == 'F') {
                    $btn = '<a href="javascript:void(0)" id=' . $row->id . ' title="Start Task"  class="start-task btn btn-primary mr-2">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    </a>';
                }
                if ($row->status != 'O' || $row->status == 'S'|| $row->status == 'F') {
                    $btn .= '<a href="javascript:void(0)" title="Finished Task" data-id=' . $row->id . ' class="finish-task btn btn-success mr-2">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        </a>';
                }
                return $btn;
            })
            ->rawColumns(['title', 'taskstatus', 'action', 'duration'])
            ->make(true);

    }

    /**
     * Stop the running task.
     * 
     * @param $runningTask
     * 
     */
    public function runningTask($runningTask)
    {   
        $runningTask->update(['status' => 'S', 'stop_date_time' => getCurrenDateTime()]);

        $duration = getTimeDifference($runningTask->stop_date_time, $runningTask->start_date_time);

        $userId = Auth::user()->id;
        
        $attendanceId = Attendance::whereDate('created_at', Carbon::today())->where('user_id',$userId)->pluck('id')->first();
        
        $data = [
            'user_id' => $userId,
            'duration' => $duration,
            'attendance_id' => $attendanceId
        ];

        //code for mananging the daily work hour
        $dailyWorkHour = DailyWorkHour::whereDate('created_at', Carbon::today())->where('user_id',$userId)->first();

        if ($dailyWorkHour) {
            $updateDailyWorkHour = $duration;
            $updateDailyWorkHour += $dailyWorkHour->duration;
            $dailyWorkHour->update(['duration' => $updateDailyWorkHour]);
        } else {
            DailyWorkHour::create($data);
        }

        if ($runningTask->duration > 0) {
            $duration += $runningTask->duration;
        }
        $runningTask->update(['duration' => $duration]);
    }

    /**
     * Send data to datatable.
     * @param $task
     * @return Response
     */
    public function loadtask($task) 
    {
        return Datatables::of($task)
            ->addIndexColumn()
            ->addColumn('title', function ($row) {
                $title = '<a href='.route('admin.task.history',$row->tid).'>'.$row->title.'</a>';
                return $title;
            })
            ->addColumn('project-title', function ($row) {
                return $row->project->title;
            })
            ->addColumn('username', function ($row) {
                return $row->user->name;
            })
            ->addColumn('duration', function ($row) {
                return $row->duration;
            })
            ->addColumn('taskstatus', function ($row) {
                if ($row->status == 'O') {
                    $button = '<a href=javascript:void(0)" class="start-task btn btn-primary">On Going</a>';
                } elseif ($row->status == 'F') {
                    $button = '<a href="javascript:void(0)" class="start-task btn btn-success">Finished</a>';
                } else {
                    $button = '<a href="javascript:void(0)" class="start-task btn btn-danger">Stopped</a>';
                }
                return $button;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href='.route('admin.task.edit',$row->tid).' id="edit-btn" title="Edit Task"  class="edit-task btn btn-primary mr-2">
                    <i class="fa fa-fw" aria-hidden="true" title="edit task"></i>
                    </a>';
                
                $btn = $btn.'<a href="javascript:void(0)" title="Delete Task" id='.$row->tid.' class="delete-task btn btn-danger mr-2">
                    <i class="fa fa-fw" aria-hidden="true" title="delete"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['title','taskstatus','action','duration'])
            ->make(true);
    }
}
