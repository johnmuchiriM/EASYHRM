<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Role\Models\Role;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $roles = ['Admin','Project Manager','Team Lead','Software Engineer'];
        foreach($roles as $key => $role) {
            Role::create([
                'name' => $role,
                'priority' => $key,
            ]);
        }
    }
}
