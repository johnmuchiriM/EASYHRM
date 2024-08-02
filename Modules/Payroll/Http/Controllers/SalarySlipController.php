<?php

namespace Modules\Payroll\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Payroll\Entities\Payroll;
use Auth;
use PDF;

class SalarySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   
        $userId = Auth::user()->id;
        $payrolls = Payroll::where('user_id',$userId)->get();
        return view('payroll::salary-slip.index',compact('payrolls'));
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function view($id)
    {   
        $payroll = Payroll::find($id);
        
        $earning = $payroll->basic_salary + $payroll->house_rent_allowance + $payroll->convenyance_allowance + $payroll->medical_allowance + $payroll->skill_allowance + $payroll->bonus; 
        
        $deduction = $payroll->provident_fund + $payroll->pf_arrear + $payroll->esi + $payroll->leave_deduction + $payroll->esic_arrear + $payroll->tds + $payroll->loan_deduction + $payroll->incomplete_working_hours + $payroll->other_deduction; 
        
        return view('payroll::salary-slip.view',compact('payroll','earning','deduction'));
    }

     /**
     * Download Salary slip in pdf format
     * @param int $id
     * @return Download PDF file
     */
    public function downloadSalarySlip($id)
    {   
        $payroll = Payroll::find($id);
        
        $earning = $payroll->basic_salary + $payroll->house_rent_allowance + $payroll->convenyance_allowance + $payroll->medical_allowance + $payroll->skill_allowance + $payroll->bonus; 
        
        $deduction = $payroll->provident_fund + $payroll->pf_arrear + $payroll->esi + $payroll->leave_deduction + $payroll->esic_arrear + $payroll->tds + $payroll->loan_deduction + $payroll->incomplete_working_hours + $payroll->other_deduction; 
        
        $pdf = PDF::loadView('payroll::salary-slip.pdf-view', compact('payroll','earning','deduction'));

        $currentMonthYear = $payroll->created_at->format('M Y');

        return $pdf->download($currentMonthYear.'-'.'salary-slip.pdf');
    }

}
