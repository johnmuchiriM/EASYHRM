<?php

namespace Modules\Holidays\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Holidays\Entities\Holiday;
use Session;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $holiday = Holiday::orderBy('created_at', 'DESC')->get();
        return view('holidays::index', compact('holiday'));
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return Holiday::find($id);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|',
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $holiday = $request->except('_token');
        $holiday['name'] = strip_tags($request->name);
            
        if ($request->id != null) {
            $holidays = Holiday::findorfail($request->id);
            $holidays->update($holiday);
            Session::flash('success', __('holidays::lang.successfully-updated'));

        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|unique:holidays',
                'date' => 'required|date_format:Y-m-d',
                
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
            Holiday::create($holiday);
            Session::flash('success', __('holidays::lang.successfully-created'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Holiday::where('id', $id)->delete();
        Session::flash('success', __('holidays::lang.successfully-deleted'));
        return true;
    }
}
