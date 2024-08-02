<?php

namespace Modules\Configurations\Entities;

use Illuminate\Database\Eloquent\Model;

class Configurations extends Model
{
    protected $guarded = [];


    //create or update config 
    static function createORUpdateConfig(array $arr)
    {
        // updating data
        foreach ($arr as $configName => $val) { 
            $configModel = self::where('config', $configName)->first();
            $configModel->update(['value' => $val]);
        }

        return true;
    }
    
}
