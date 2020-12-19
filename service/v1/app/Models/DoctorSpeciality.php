<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
    protected $table = 'doctor_specialities';

    protected $primaryKey = 'doctor_speciality_id';

    public $timestamps = false;
}
