<?php

namespace Database\Seeders;
use App\Models\User;
use Modules\Employees\Entities\Employee;
use Modules\Employees\Entities\ParentRelativeDetail as Relative;
use Modules\Employees\Entities\PreviousEmployementHistory as EmployeeHistory;
use Faker\Factory as Faker;
use Modules\Attendances\Entities\Attendance;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\DailyWorkHour;
use Illuminate\Database\Seeder;
use Modules\Tasks\Entities\Task;
use Modules\Vacations\Entities\AllocateLeave;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker::create();

        User::create([
            'name' => 'shaiv',
            'role_id' => 2,
            'email' => 'shaiv@test.com',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'sumit',
            'role_id' => 3,
            'email' => 'sumit@test.com',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'shivam',
            'role_id' => 4,
            'email' => 'shivam@test.com',
            'password' => bcrypt('123456')
        ]);
        
        for($i=2;$i<=4;$i++) {
            Employee::create([
                'employee_name' =>  $faker->name,
                'gender' =>  'm',
                'date_of_birth' =>  '1995-05-18',
                'father_husband_name' =>  $faker->name,
                'primary_email' =>  $faker->email,
                'mobile_number' =>  $faker->randomDigit,
                'current_address' =>  $faker->address,
                'permanent_address' =>  $faker->address,
                'resume' =>   'test.img',
                'photo' =>  'test.img',
                'address_proof' =>   'test.img',
                'pan_card' =>  'test.img',
                'hourly_rate' =>  NULL,
                'date_of_joining' =>  '2021-02-18',
                'notes' =>  NULL,
                'user_id' => $i,
            ]);
        }

        for($i=2;$i<=4;$i++) {
            Relative::create([
                'user_id' => $i,
            ]);
        }

        for($i=2;$i<=4;$i++) {
            EmployeeHistory::create([
                'user_id' => $i,
            ]);
        }

        for($i=2;$i<=4;$i++) {
            Attendance::create([
                'user_id' => $i,
                'logged_in' => '2021-05-14 10:42:13',
                'logged_out' => '2021-05-14 21:42:13',
                'created_at' => '2021-05-14 10:42:13',
            ]);
        }

        $j = 1;
        for($i=2;$i<=4;$i++) {
            DailyWorkHour::create([
                'user_id' => $i,
                'attendance_id' => $j,
                'duration' => 5.34+$i,
            ]);
           $j++; 
        }

        Project::create([
            'user_id' => 1,
            'title' => 'Bug Management System',
            'specification' => 'Bug Management System',
            'start_date' => '2021-05-18',
            'deadline' => '2021-05-22' ,
            'status' => 'O',
        ]);

        Project::create([
            'user_id' => 1,
            'title' => 'Ticket Management System',
            'specification' => 'Ticket Management System',
            'start_date' => '2021-05-10',
            'deadline' => '2021-05-12' ,
            'status' => 'O',
        ]);

        Project::create([
            'user_id' => 1,
            'title' => 'School Management System',
            'specification' => 'School Management System',
            'start_date' => '2021-05-15',
            'deadline' => '2021-05-20' ,
            'status' => 'O',
        ]);

        Task::create([
            'user_id' => 2 ,
            'project_id' => 1,
            'assigned_to' => 2,
            'title' => 'Bug Management System',
            'specification' => 'Bug Management System',
            'create_date' => '2021-05-19',
            'deadline' => '2021-05-20',
            'status' => 'S',
        ]);

        Task::create([
            'user_id' => 3 ,
            'project_id' => 2,
            'assigned_to' => 3,
            'title' => 'ticket management system',
            'specification' => 'ticket management system',
            'create_date' => '2021-05-10',
            'deadline' => '2021-05-12',
            'status' => 'S',
        ]);

        Task::create([
            'user_id' => 4 ,
            'project_id' => 3,
            'assigned_to' => 4,
            'title' => 'School Management System',
            'specification' => 'School Management System',
            'create_date' => '2021-05-16',
            'deadline' => '2021-05-18',
            'status' => 'S',
        ]);
        
        for($i=2;$i<=4;$i++) {
            AllocateLeave::create([
                'user_id' => $i,
                'allocate_leave' => 12+$i,
            ]);
        }

    }
}
