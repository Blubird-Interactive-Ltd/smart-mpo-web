<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Doctor_chamber extends Model
{
    protected $table = 'doctor_chambers';

    protected $primaryKey = 'doctor_chamber_id';

    public $timestamps = false;
}
