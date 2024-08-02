<?php

namespace Modules\Payroll\Traits;
use Illuminate\Support\Facades\Validator;


/**
 * this trait is use for form validation
 */
trait FormValidationTrait
{
   /**
     * Validate the form data
     * @param array $request
     * @return Response
     */
    protected function FormData($request)
    {
        $formData = $request->except('_token');

        $validator = Validator::make($formData, [
            'basic_salary' => 'numeric|min:1',
            'house_rent_allowance' => 'nullable|numeric|min:0',
            'convenyance_allowance' => 'nullable|numeric|min:0',
            'medical_allowance' => 'nullable|numeric|min:0',
            'skill_allowance' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'provident_fund' => 'nullable|numeric|min:0',
            'pf_arrear' => 'nullable|numeric|min:0',
            'esi' => 'nullable|numeric|min:0',
            'esic_arrear' => 'nullable|numeric|min:0',
            'tds' => 'nullable|numeric|min:0',
            'loan_deduction' => 'nullable|numeric|min:0',
            'incomplete_working_hours' => 'nullable|numeric|min:0',
            'leave_deduction' => 'nullable|numeric|min:0',
            'other_deduction' => 'nullable|numeric|min:0',
            'gross_salary' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {

            return $validator;
        }

        $grossSalary = $request->basic_salary + $request->house_rent_allowance + $request->convenyance_allowance + $request->medical_allowance + $request->skill_allowance + $request->bonus - $request->provident_fund - $request->pf_arrear - $request->esi - $request->esic_arrear - $request->tds - $request->loan_deduction - $request->incomplete_working_hours - $request->leave_deduction - $request->other_deduction;

        $formData['gross_salary'] = $grossSalary;

        return $formData;
    }
}