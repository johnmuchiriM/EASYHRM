<?php
namespace Modules\Vacations\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Vacations\Entities\AllocateLeave;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;

class AllocateLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $allocateLeaveUserId = AllocateLeave::pluck('user_id')->toArray();
        if (empty($allocateLeaveUserId)){
            $allocateLeaveUserId = [];
        }
        $users = User::where('role_id','<>','1')->whereNotIn('id',$allocateLeaveUserId)->get();
        $leaves = AllocateLeave::orderBy('created_at', 'DESC')->get();
        return view('vacations::allocate-leave.index', compact('leaves','users'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return User::leftjoin('allocate_leaves', 'users.id', '=', 'allocate_leaves.user_id')
        ->where('allocate_leaves.id',$id)
        ->first();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'allocate_leave' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $leaves = $request->except('_token');
        $leaves['user_id'] = $request->user_id ?? '' ;
        
        if ($request->id != null) {            
            AllocateLeave::where('id', $request->id)->update(['allocate_leave'=>$request->allocate_leave]);
            Session::flash('success', __('vacations::lang.successfully-updated-leave'));

        } else {
            AllocateLeave::create($leaves);
            Session::flash('success', __('vacations::lang.successfully-created-leave'));
        }
    }
  
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        AllocateLeave::where('id', $id)->delete();
        Session::flash('success', __('vacations::lang.successfully-deleted-leave'));
        return true;
    }
}
