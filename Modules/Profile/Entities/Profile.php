<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];


    //get the user associated with attendance
    // public function user()
    // {
    //    return  $this->belongsTo(\App\Models\User::class, 'user_id');
    // }
    
}
