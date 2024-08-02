<?php

namespace Modules\Role\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [''];

    /**
     * save role associated with users
     */
    public static function createRole(array $params)
    {
        return self::create($params);
    }

    /**
     * get role by role_id
     */
    public static function editRole($id = '')
    {
        return self::where('id', $id)->first();
    }

    /**
     * destroy role by role_id
     */
    public static function deleteRole($id = '')
    {
        return self::find($id)->delete();
    }

    
    /**
     * Get the role
     */
    public static function getRole()
    {
        return self::get();
    }

    /**
     * Get the role record associated with the user.
     */
    public function UserRole()
    {
        return $this->hasOne('App\Models\User');

    }

    /**
     * Get the user record associated with the role.
     */
    public function User()
    {
        return $this->hasOne('App\Models\User');
    }
}
