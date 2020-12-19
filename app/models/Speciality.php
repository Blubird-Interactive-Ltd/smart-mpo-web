<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'specialities';

    protected $primaryKey = 'speciality_id';

    public $timestamps = false;
}
