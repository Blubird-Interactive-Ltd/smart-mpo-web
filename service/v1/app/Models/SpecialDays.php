<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialDays extends Model
{
    protected $table = 'system_special_days';

    protected $primaryKey = 'system_special_day_id';

    public $timestamps = false;
}
