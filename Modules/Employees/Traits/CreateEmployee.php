<?php
namespace Modules\Employees\Traits;
use App\Models\User;
use Modules\Employees\Entities\Employee;
use Modules\Employees\Entities\ParentRelativeDetail as Relative;
use Modules\Employees\Entities\PreviousEmployementHistory as EmployeeHistory;
use Illuminate\Support\Facades\DB;

/**
 * this trait is use to create employee
 */
trait CreateEmployee
{
    public function storeEmployee($request)
    {   
        try {
            
            //moving the file to public/admin/uploads folder
            $resume = rand().'.'.$request->resume->extension();  
            $request->resume->move(public_path('admin/uploads'), $resume);
            
            $photo = rand().'.'.$request->photo->extension();  
            $request->photo->move(public_path('admin/uploads'), $photo);
            
            // move multiple file to public/admin/uploads folder
            if($files = $request->file('address_proof')) {
                foreach($files as $file) {
                    $name = rand().'.'.$file->extension();
                    $file->move(public_path('admin/uploads'),$name);
                    $addressProof[] = $name;
                }
            }

            if($files = $request->file('pan_card')) {
                foreach($files as $file) {
                    $name = rand().'.'.$file->extension();
                    $file->move(public_path('admin/uploads'),$name);
                    $panCard[] = $name;
                }
            }

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'role_id' =>  $request->role_id,
                'password' => bcrypt($request->password),
            ];

            $user = User::create($userData); // create data in users table

            $employeePersonalData = [
                'employee_name' => $request->employee_name ?? NULL,
                'gender' => $request->gender ?? NULL,
                'date_of_birth' => $request->date_of_birth ?? NULL,
                'father_husband_name' => $request->father_husband_name ?? NULL,
                'primary_email' => $request->primary_email ?? NULL,
                'mobile_number' => $request->mobile_number ?? NULL,
                'current_address' => $request->current_address ?? NULL,
                'permanent_address' => $request->permanent_address ?? NULL,
                'resume' => $resume ?? NULL,
                'photo' => $photo ?? NULL,
                'address_proof' => implode(",",$addressProof) ?? NULL,
                'pan_card' => implode(",",$panCard) ?? NULL,
                'hourly_rate' => $request->hourly_rate ?? NULL,
                'date_of_joining' => $request->date_of_joining ?? NULL,
                'notes' => $request->notes ?? NULL,
                'user_id' => $user->id,
            ];

            $employee = Employee::create($employeePersonalData); // create data in previous_employement_histories table
            
            $parentDetail = [
                'user_id' => $user->id ?? NULL,
                'father_name' => $request->father_name ?? NULL,
                'mother_name' => $request->mother_name ?? NULL,
                'mother_mobile_number' => $request->mother_mobile_number ?? NULL,
                'father_mobile_number' => $request->father_mobile_number ?? NULL,
                'friend_name' => $request->friend_name ?? NULL,
                'friend_mobile_number' => $request->friend_mobile_number ?? NULL,
            ];
            
            Relative::create($parentDetail); // create data in parent_relaives_details table

            if($previousCompanyDetails = $request->previous_company_name) {
                foreach($previousCompanyDetails as $key => $previousCompanyDetail) {

                    if(isset($request->relieving_letter[$key])) {
                        $relievingLetter = rand().'.'.$request->relieving_letter[$key]->extension();  
                        $request->relieving_letter[$key]->move(public_path('admin/uploads'), $relievingLetter);
                    }
                    
                    if(isset($request->experience_letter[$key])) {
                        $experienceLetter = rand().'.'.$request->experience_letter[$key]->extension();  
                        $request->experience_letter[$key]->move(public_path('admin/uploads'), $experienceLetter);
                    }
                    
                    $previousCompanyData = [
                        'user_id' => $user->id,
                        'previous_company_name' => $previousCompanyDetail,
                        'contact_person_number' => $request->contact_person_number[$key] ?? NULL,
                        'previous_company_date_of_joining' => $request->previous_company_date_of_joining[$key] ?? NULL,
                        'previous_company_date_of_relieving' => $request->previous_company_date_of_relieving[$key] ?? NULL,
                        'contact_person_name' => $request->contact_person_name[$key] ?? NULL,
                        'relieving_letter' => $relievingLetter ?? NULL,
                        'experience_letter' => $experienceLetter ?? NULL,
                    ];
                    EmployeeHistory::create($previousCompanyData);
                }
            }
        } catch(\Exception $e) {
            DB::rollback();
        }
        
        
    }
}