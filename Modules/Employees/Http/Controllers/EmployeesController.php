<?php

namespace Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Role\Models\Role;
use App\Models\User;
use Modules\Employees\Entities\PreviousEmployementHistory as EmployeeHistory;
use Modules\Employees\Traits\CreateUpdateTrait; 
use Session;

class EmployeesController extends Controller
{   
    use CreateUpdateTrait;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   
        $employees = User::where('role_id','<>','1')->get();
        return view('employees::index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {   
        $roles = Role::where('id','<>','1')->get();
        return view('employees::create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {       
        
        //employee validation
        $request->validate([
            'employee_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'date_of_birth' => 'required',
            'father_husband_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'primary_email' => 'required|email',
            'mobile_number' => 'required|numeric|min:0',
            'current_address' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'permanent_address' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'resume' => 'required|image|mimes:jpeg,png,jpg,pdf,xml,doc,docx|max:10000',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'address_proof.*' => 'required|image|mimes:jpeg,png,jpg|max:3400',
            'pan_card.*' => 'required|image|mimes:jpeg,png,jpg|max:2400',
            'date_of_joining' => 'required',
            'employee_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'father_mobile_number' => 'nullable|numeric',
            'mother_mobile_number' => 'nullable|numeric',
            'friend_mobile_number' => 'nullable|numeric',
            'father_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'mother_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'friend_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'experience_letter.*' => 'nullable|image|mimes:jpeg,png,jpg,pdf,xml,doc,docx|max:10000',
            'relieving_letter.*' => 'nullable|image|mimes:jpeg,png,jpg,pdf,xml,doc,docx|max:10000',
            'previous_company_name.*' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'contact_person_name.*' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'contact_person_number.*' => 'nullable|numeric',
        ],[
            'previous_company_name.*.regex' => 'Company name must be alpha numeric'
        ]);

        // call CreateEmployee Trait function
        $this->storeEmployee($request);   

        return redirect()->to(route('admin.employees'))->with('success', __('employees::employee.created'));     
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('employees::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $UserId
     * @return Renderable
     */
    public function edit($userId)
    {   
        $user = User::find($userId);
        
        $roles =  Role::get();
        $employeeHistories = EmployeeHistory::where('user_id',$userId)->get();
        
        $employee = $user->employee; // get data from employees table
        $relative =  $user->relative; // get data from parent_relative_details table

        $addressProofFiles = isset($employee->address_proof) ? explode(",",$employee->address_proof) : '';

        $panFiles = isset($employee->pan_card) ? explode(",",$employee->pan_card) : '';
        
        return view('employees::edit',compact('user','roles','employee','addressProofFiles','panFiles','relative','employeeHistories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $userId
     * @return Renderable  
     */
    public function update(Request $request, $userId)
    {   
        //validation during employee update
        $request->validate([
            'employee_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'date_of_birth' => 'required',
            'father_husband_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'primary_email' => 'required|email',
            'mobile_number' => 'required|numeric|min:0',
            'current_address' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'permanent_address' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'date_of_joining' => 'required',
            'employee_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId,
            'resume' => 'nullable|image|mimes:jpeg,png,jpg,pdf,xml,doc,docx|max:10000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'address_proof.*' => 'required|image|mimes:jpeg,png,jpg|max:3400',
            'pan_card.*' => 'required|image|mimes:jpeg,png,jpg|max:2400',
            'father_mobile_number' => 'nullable|numeric',
            'mother_mobile_number' => 'nullable|numeric',
            'friend_mobile_number' => 'nullable|numeric',
            'father_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'mother_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'friend_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'experience_letter.*' => 'nullable|image|mimes:jpeg,png,jpg,pdf,xml,doc,docx|max:10000',
            'relieving_letter.*' => 'nullable|image|mimes:jpeg,png,jpg,pdf,xml,doc,docx|max:10000',
            'previous_company_name.*' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'contact_person_name.*' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            'contact_person_number.*' => 'nullable|numeric',
        ],[
            'previous_company_name.*.regex' => 'Company name must be alpha numeric'
        ]);

        // call CreateEmployee Trait function
        $this->editEmployee($request,$userId);   
        
        return redirect()->to(route('admin.employees'))->with('success', __('employees::employee.updated'));   
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return response
     */
    public function destroy($userId)
    {
        $user = User::find($userId);
        
        $user->delete();
        $user->employee()->delete(); 
        $user->relative()->delete(); 

        EmployeeHistory::where('user_id',$userId)->delete();

        Session::flash('danger', __('employees::employee.deleted'));

        return true;
    }
}
