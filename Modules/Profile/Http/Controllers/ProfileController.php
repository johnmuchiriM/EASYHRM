<?php

namespace Modules\Profile\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employees\Entities\Employee;
use Modules\Employees\Entities\PreviousEmployementHistory as EmployeeHistory;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $employeeHistories = EmployeeHistory::where('user_id', Auth::user()->id)->get();
        if($user->role_id != 1) {
            return view('profile::index', compact('user', 'employeeHistories'));
        } else {
            return view('profile::admin-profile', compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('profile::create');
    }

   
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('profile::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('profile::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {   
        $user = Auth::user();

        if($user->role_id == 1) {
            $request->validate([
                'name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
                'email' => 'required|email',
                'profile_pic' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
        } else {
            $request->validate([
                'name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
                'primary_email' => 'required|email',
                'profile_pic' => 'image|mimes:jpeg,png,jpg|max:2048',
                'mobile_number' => 'required|min:10|numeric',
                'father_mobile_number' => 'nullable|min:10|numeric',
                'mother_mobile_number' => 'nullable|min:10|numeric',
                'friend_mobile_number' => 'nullable|min:10|numeric',
                'father_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
                'mother_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
                'friend_name' => 'nullable|regex:/(^[A-Za-z0-9 ]+$)+/',
            ]);
        }
        
        $data = $request->all();

        $userTable = User::find($user->id);
        
        $updateValue = [];
        //save the user's profile_pic
        if ($request->hasfile('profile_pic')) {
            $file = $request->file('profile_pic');
            $fileName = str_replace(' ','_',trim($file->getClientOriginalName()));
            $refactorName = preg_replace('/\s+/', '', $fileName);
            $file->move(public_path() . "/User/profile_pic/{$user->id}", $refactorName);
            $profilePic = \URL("/User/profile_pic/{$user->id}/" . $fileName);
        }

        if($user->role_id == 1) {
            
            $updateValue['name'] = strip_tags($data['name']);
            $updateValue['profile_pic'] = isset($profilePic) ? $profilePic : $userTable->profile_pic;
            $updateValue['email'] = strip_tags($data['email']);

            $userTable->update($updateValue);

            return redirect()->back()->with('success', __('profile::lang.profile-updated'));
        } 

        $employee = [];
 
        $employee['name'] = strip_tags($request->name);
        $employee['primary_email'] = strip_tags($request->primary_email);
        $employee['mobile_number'] = strip_tags($request->mobile_number);

        $relative = [];

        $relative['mobile_number'] = strip_tags($request->mobile_number);
        $relative['father_mobile_number'] = strip_tags($request->father_mobile_number);
        $relative['mother_mobile_number'] = strip_tags($request->mother_mobile_number);
        $relative['friend_mobile_number'] = strip_tags($request->friend_mobile_number);
        $relative['friend_name'] = strip_tags($request->friend_name);
        $relative['mother_name'] = strip_tags($request->mother_name);

        $updateValue = [
            'name' => $data['name'],
            'profile_pic' => isset($profilePic) ? $profilePic : $userTable->profile_pic,
        ];

        //update when emp value available
        if (isset($employee) && !empty($employee)) {
            $userTable->employee->update($employee);
        }

        //update when relative value available
        if (isset($relative) && !empty($relative)) {
            $userTable->relative->update($relative);
        }

        if (isset($updateValue) && !empty($updateValue)) {
            $userTable->update($updateValue);
        }
        return redirect()->back()->with('success', __('profile::lang.profile-updated'));
    }

}
