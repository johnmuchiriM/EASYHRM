<?php

namespace Modules\Attendances\Entities;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];


    //get the user associated with attendance
    public function user()
    {
       return  $this->belongsTo(\App\Models\User::class, 'user_id');
    }
   //daily work hours for user associated with attendance
   public function dailyHour()
   {
      return $this->hasOne(\Modules\Tasks\Entities\DailyWorkHour::class);
   }
}
