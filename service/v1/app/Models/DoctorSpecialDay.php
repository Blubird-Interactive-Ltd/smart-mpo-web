<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecialDay extends Model
{
    protected $table = 'doctor_special_days';

    protected $primaryKey = 'doctor_special_day_id';

    public $timestamps = false;
}
