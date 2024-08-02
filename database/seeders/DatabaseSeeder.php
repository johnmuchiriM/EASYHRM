<?php

namespace Database\Seeders;

use App\Models\Timezone;
use Illuminate\Database\Seeder;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\Configurations\Database\Seeders\ConfigurationsDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(RoleDatabaseSeeder::class);
        $this->call(UsersTableDataSeeder::class);
        $this->call(ConfigurationsDatabaseSeeder::class);
        $this->call(TimezoneSeeder::class);
        // You can uncomment the below one, when you want to create fake data during installaion
        // $this->call(FakerSeeder::class);
    }
    
}
