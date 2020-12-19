<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DoctorContact extends Model
{
    protected $table = 'doctor_contacts';

    protected $primaryKey = 'doctor_contact_id';

    public $timestamps = false;
}
