<?php

namespace Modules\Payroll\Entities;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];

    /**
     * Get the user record associated with the payroll.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
