<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];


    /**
     * get the user associated with task
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to'); 
    }

    /**
     * get the project associated with task
     */
    public function project()
    {
        return $this->belongsTo(\Modules\Projects\Entities\Project::class, 'project_id'); 
    }

}
