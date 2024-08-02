<?php

namespace Modules\Vacations\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AllocateLeave extends Model
{
    use HasFactory;

    protected $guarded = [];

/**
 * get the user associated with allocate leave
**/
    public function user()
    {
        return $this->belongsTo('App\Models\User'); 
    }
}
