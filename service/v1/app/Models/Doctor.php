<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $primaryKey = 'doctor_id';

    public $timestamps = false;

    #one to many cat relation
    public function home_address()
    {
        return $this->hasMany(DoctorHomeAddress::class,'doctor_id');
    }

    #one to many cat relation
    public function contacts()
    {
        return $this->hasMany(DoctorContact::class,'doctor_id');
    }

    #one to many cat relation
    public function chambers()
    {
        return $this->hasMany(Doctor_chamber::class,'doctor_id');
    }
}
