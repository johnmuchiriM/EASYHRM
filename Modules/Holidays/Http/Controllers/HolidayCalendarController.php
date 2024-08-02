<?php

namespace Modules\Holidays\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Holidays\Entities\Holiday;

class HolidayCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return Renderable
     */
    public function index()
    {
        return view('holidays::holiday-calendar.index');
    }
    
    /**
     * Load Calendar Data.
     * 
     * @return Response
     */
    public function loadCalendar()
    {
        $holiday = Holiday::get();
        foreach ($holiday as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['title'] = $value->name;
            $data[$key]['start'] = $value->date;
        }
        return json_encode($data);
    }
}
