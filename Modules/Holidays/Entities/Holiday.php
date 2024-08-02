<?php

namespace Modules\Holidays\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;
    protected $table = 'holidays';
    protected $guarded = [];
    
}
