<?php
namespace Modules\Vacations\Http\Controllers;

use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Attendances\Entities\Attendance;
use Modules\Vacations\Entities\AllocateLeave;
use Modules\Vacations\Entities\Vacation;
use Session;

class VacationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $vacation = Vacation::where('user_id', $userId)->get();
        $remainingLeave = AllocateLeave::where('user_id', $userId)->first('allocate_leave');
        $paidLeaves = Vacation::where('user_id', $userId)->groupBy('user_id')->sum('paid_leave');
        return view('vacations::index', compact('vacation', 'remainingLeave', 'paidLeaves'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'reason' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:3',
            'start_date' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date',
            'paid' => 'numeric|min:0',
            'unpaid' => 'numeric|min:0', 

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $vacation = $request->except('_token', 'vacation_id');

        $vacation['user_id'] = $userId;

        $fdate = $vacation['start_date'];
        $tdate = $vacation['end_date'];
        $datetime1 = strtotime($fdate); // convert to timestamps
        $datetime2 = strtotime($tdate); // convert to timestamps
        $days = (int) (($datetime2 - $datetime1) / 86400);
        if ($days == 0) {
            $days = 1 / 2;
        }

        $vacationVal = Vacation::where('id', $request->vacation_id)->first();

        $vacation['paid_leave'] = (is_null($vacation['paid_leave']) ? $vacationVal->paid_leave : $vacation['paid_leave']);
        $vacation['unpaid_leave'] = (is_null($vacation['unpaid_leave']) ? $vacationVal->unpaid_leave : $vacation['unpaid_leave']);

        $vacation['days'] = $days;
        $attendance = Attendance::whereDate('created_at', Carbon::today())->where('user_id', $userId)->first();
        if (!isset($attendance->logged_in)) {
            Session::flash('error', __('vacations::lang.you-have-been-logged-in-first'));
        } else if (isset($attendance->logged_out)) {
            Session::flash('error', __('vacations::lang.you-have-been-logged-out'));
        } else if ($request->vacation_id != null) {
            Vacation::where('id', $request->vacation_id)->update($vacation);
            Session::flash('success', __('vacations::lang.successfully-updated'));
        } else {
            Vacation::create($vacation);
            Session::flash('success', __('vacations::lang.successfully-created'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return Vacation::find($id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Vacation::where('id', $id)->delete();
        Session::flash('success', __('vacations::lang.successfully-deleted'));
        return true;
    }

}
