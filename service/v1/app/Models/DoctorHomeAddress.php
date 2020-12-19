<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorHomeAddress extends Model
{
    protected $table = 'doctor_home_address';

    protected $primaryKey = 'doctor_home_address_id';

    public $timestamps = false;
}
