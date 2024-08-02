<?php

namespace Modules\Attendances\Http\Controllers;

use Auth;
use Carbon\Carbon;
use DataTables;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Log;
use Modules\Attendances\Entities\Attendance;
use Modules\Tasks\Entities\Task;
use Session;

class AttendancesController extends Controller
{

    /**
     * Instantiate a new AttendancesController instance.
     */
    public function __construct()
    {
        $this->logChannel = Log::channel('emp_attendances');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $attendance = Attendance::whereDate('created_at', Carbon::today())->where('user_id', $userId)->first();
        // $taskStatus = Task::where('assigned_to', $userId)->pluck('id','status')->toArray();
        //  dd($taskStatus);
        // if($taskStatus == 'O') {
        //     Session::flash('error', __('attendances::lang.one-of-your-task-is-running'));
        // }
     
        return view('attendances::index', compact('attendance'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return response
     */
    public function getAttendances()
    {
        $userId = Auth::user()->id;

        $data = Attendance::orderBy('id', 'DESC')->where('user_id', $userId)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('logged_in', function ($row) {
                return formatDateTime($row->logged_in);
            })
            ->addColumn('logged_out', function ($row) {
                if (isset($row->logged_out)) {
                    return formatDateTime($row->logged_out);
                } else {
                    return 'Not Logged Out';
                }

            })
            ->addColumn('totalhours', function ($row) {

                if (isset($row->logged_out)) {
                    $hours = getTimeDifference($row->logged_out, $row->logged_in);
                } else {
                    $hours = 'Not Available';
                }

                return $hours;
            })
            ->addColumn('working_hours', function ($row) {
                if (isset($row->dailyHour->duration)) {
                    return ($row->dailyHour->duration);
                } else {
                    return __('dashboard::lang.not-available');
                }
            })
            ->rawColumns(['totalhours'])
            ->make(true);
    }

    /**
     * Function to insert data when user loggedIn
     *
     * @return response
     */
    public function loggedIn()
    {
        $data['user_id'] = Auth::user()->id;
        $data['logged_in'] = getCurrenDateTime();
        $attendance = Attendance::whereDate('created_at', Carbon::today())->where('user_id', $data['user_id'])->get();
        if ($attendance->isEmpty()) {
            $logContent = 'UserId ' . $data['user_id'] . ' Attendance marked as loggedIn  from the Employee portal at ' . getCurrenDateTime();
            $this->writeToLogs($logContent);
            Attendance::create($data);
            return response()->json(['is_logged_in' => 0]);
        } else {
            return response()->json(['is_logged_in' => 1]);
        }

    }

    private function writeToLogs($logContent)
    {
        $this->logChannel->info($logContent);

        Log::info($logContent);
    }

    /**
     * Function to insert data when user loggedIn
     *
     * @return response
     */
    public function loggedOut()
    {
        $currentTime = getCurrenDateTime();

        $userId = Auth::user()->id;

        $attendance = Attendance::whereDate('created_at', Carbon::today())->where('user_id', $userId)->first();


        $taskStatus = Task::where('assigned_to', $userId)->where('status', 'O')->pluck('status')->first();

        if (isset($taskStatus)) {
            Session::flash('error', __('attendances::lang.one-of-your-task-is-running'));
            return 0;
        } else if ($attendance->logged_out == null) {

            $logContent = 'UserId ' . $userId . ' Attendance marked as loggedOut  from the Employee portal at ' . getCurrenDateTime();
            $this->writeToLogs($logContent);
            $attendance->update(['logged_out' => $currentTime]);
        }
        return true;
    }
}
