<?php

namespace Modules\Configurations\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Configurations\Entities\Configurations;
use App\Models\User;

class ConfigurationsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * run only one time when application is in demo mode other wise that seed will override all the config
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $configurations = [
            'config_company_name' => 'CodeHunger Pvt. Ltd.',
            'config_company_address' => 'Rai Jai Krishna Rd, Gurhatta, Sadikpur, Patna, Bihar 800008',
            'config_app_name' => 'CodeHunger HRM',
            'config_app_currency' => 'INR',
            'config_app_lang' => 'en',
            'config_app_logo' => '',
            'config_app_favicon_icon' => '',
            'config_app_timestamp' => 'Asia/Kolkata',
            'config_color_scheme_class' => 'bg-primary',
            'config_right_footer_1' => 'CodeHunger HRM',
            'config_right_footer_2' => 'V.1.0.0',
            'config_left_footer_1' => 'All rights reserved',
            'config_left_footer_2' => '&copy;',
            'config_is_footer_fixed' => 'fixed-footer',
            'config_is_header_fixed' => 'fixed-header',
            'config_is_sidebar_fixed' => 'fixed-sidebar',
        ];
        
        foreach ($configurations as $key => $config) {
            $insert = [
                'config' => $key,
                'value' => $config,
            ];
            Configurations::create($insert);
        }
    }
}
