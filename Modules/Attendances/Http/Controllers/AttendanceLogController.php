<?php

namespace Modules\Attendances\Http\Controllers;

use Auth;
use DataTables;
use Illuminate\Routing\Controller;
use Modules\Attendances\Entities\Attendance;

class AttendanceLogController extends Controller
{
    /**
     * Index of attendance logs
     *
     * @return View
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $attendances = Attendance::orderBy('id', 'desc')->get();
        return view('attendances::attendanceLog', compact('attendances'));
    }

    /**
     * Use for getting attendance log.
     *
     * @return response
     */
    public function getAttendanceLog()
    {
        $data = Attendance::orderBy('id', 'DESC')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user_id', function ($row) {
                return ($row->user_id);
            })
            ->addColumn('user_name', function ($row) {
                return ($row->user->name);
            })
            ->addColumn('created_at', function ($row) {
                return formatDate($row->created_at);
            })
            ->addColumn('login_logout', function ($row) {
                if (isset($row->logged_out)) {
                    $login_logout = (convertdt24To12($row->logged_in) . "  <=> " . convertdt24To12($row->logged_out));
                } else  {
                    $login_logout = (convertdt24To12($row->logged_in) . "  <=> " . "Not logged out");
                }
                return ($login_logout);
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
                    $hours = getTimeDifference($row->logged_out, $row->logged_in);
                } else {
                    $hours = 'Not Available';
                }

                return $hours;
            })
            ->rawColumns(['totalhours'])
            ->make(true);
    }
}
