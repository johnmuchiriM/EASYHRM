<?php

namespace Modules\Payroll\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payroll\Entities\Payroll;
use Modules\Attendances\Entities\Attendance;
use Modules\Vacations\Entities\Vacation;
use Modules\Payroll\Traits\FormValidationTrait; 
use Session;

class PayrollController extends Controller
{   
    use FormValidationTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        $payrolls = Payroll::get();
        return view('payroll::generate-payroll.index',compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = $this->users();
        return view('payroll::generate-payroll.create', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function getData($userId)
    {
        $attendance = Attendance::whereMonth('created_at', date('m'))->where('user_id', $userId)->whereYear('created_at', date('Y'))->count();
        $paidLeave = Vacation::where('user_id',$userId)->groupBy('user_id')->sum('paid_leave');
        $unpaidLeave = Vacation::where('user_id',$userId)->groupBy('user_id')->sum('unpaid_leave');
        $returnData = [
            'attendance' => $attendance,
            'paid_leave' => $paidLeave,
            'unpaid_leave' => $unpaidLeave,

            ];
        return $returnData;

    }
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {  
        $formData = $this->FormData($request);
        
        if(is_array($formData)) {
            Payroll::create($formData);
            return redirect()->to(route('payroll'))->with('success',__('payroll::lang.success-create'));
        }
        if ($formData->fails()) {
            return redirect()->back()->withErrors($formData)->withInput();
        } 
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('payroll::generate-payroll.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {   
        $payroll = Payroll::find($id);
        $users = $this->users();

        return view('payroll::generate-payroll.edit',compact('payroll','users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $formData = $this->FormData($request);

        if(is_array($formData)) {

            Payroll::find($id)->update($formData);

            return redirect()->to(route('payroll'))->with('success',__('payroll::lang.success-update'));
        }

        if ($formData->fails()) {
            return redirect()->back()->withErrors($formData)->withInput();
        } 
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {   
        Payroll::Destroy($id);
        Session::flash('success',__('payroll::lang.success-delete'));
        return true;
    }

    /**
     * Return list of users
     * @param int $id
     * @return array
     */
    public function users()
    {   
        return User::where('role_id', '<>', '1')->get();
    }
}
