<?php

namespace Modules\Vacations\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $guarded = [''];

    /**
     * get the user associated with vacations
     */
    public function User()
    {
        return $this->belongsTo('App\Models\User'); 
    }
    public function allocateLeave()
    {
       return $this->hasOne(\Modules\Tasks\Entities\AllocateLeave::class, 'user_id','user_id');
    }
}   

 