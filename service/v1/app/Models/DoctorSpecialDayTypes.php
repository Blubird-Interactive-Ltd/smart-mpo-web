<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecialDayTypes extends Model
{
    protected $table = 'doctor_special_day_types';

    protected $primaryKey = 'doctor_special_day_type_id';

    public $timestamps = false;
}
