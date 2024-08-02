<?php
namespace Modules\Vacations\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Vacations\Entities\Vacation;
use Session;

class VacationsApprovalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $vacation = Vacation::get();
        return view('vacations::approval-status.index', compact('vacation'));
    }

    /**
     * update vacation status.
     * @param Request $request
     * @return Renderable
     */
    public function updateStatus(Request $request)
    {       
        Vacation::where('id', $request->vacation_id)->update(['status'=>$request->status]);
        Session::flash('success', __('vacations::lang.successfully-updated'));
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
