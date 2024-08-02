<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'profile_pic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the record from employees table associated with the user.
     */
    public function employee()
    {
        return $this->hasOne('Modules\Employees\Entities\Employee');
    }

    /**
     * Get the record from parent_relative table associated with the user.
    */
    public function relative()
    {
        return $this->hasOne('Modules\Employees\Entities\ParentRelativeDetail');
    }

    /**
     * Get the record from previous_employement_history table associated with the user.
    */
    public function previousHistory()
    {
        return $this->hasOne('Modules\Employees\Entities\PreviousEmployementHistory');
    }

    /**
     * Get the record from roles table associated with the user.
    */
    public function role()
    {
        return $this->belongsTo('Modules\Role\Models\Role');
    }

    /**
     * get the vacations associated with the user
     */
    public function vacations()
    {
        return $this->belongsTo('Modules\Vacations\Entities\Vacation');
    }

    //get the task which is associated with specific user
    public function tasks()
    {
       return $this->hasMany(\Modules\Tasks\Entities\Task::class, 'assigned_to');
    }
    /**
     * get the allocate leaves associated with the user
     */
    public function allocateLeave()
    {
        return $this->belongsTo('Modules\Vacations\Entities\AllocateLeave');
    }
}
