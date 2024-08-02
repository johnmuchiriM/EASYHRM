<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    /**
     * get the user associated with vacations
    */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class); 
    }

    
}
