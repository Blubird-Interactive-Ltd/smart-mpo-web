<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDcrGift extends Model
{
    protected $table = 'doctor_dcr_gifts';

    protected $primaryKey = 'doctor_dcr_gift_id';

    public $timestamps = false;
}
