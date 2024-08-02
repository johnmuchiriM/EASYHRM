<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        User::create([
            'name' => 'admin',
            'role_id' => 1,
            'email' => 'admin@codehunger.in',
            'password' => bcrypt('admin@1234')
        ]);
    }
}
