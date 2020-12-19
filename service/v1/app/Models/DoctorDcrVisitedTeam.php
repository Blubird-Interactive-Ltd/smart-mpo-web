<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDcrVisitedTeam extends Model
{
    protected $table = 'doctor_dcr_visit_team';

    protected $primaryKey = 'doctor_dcr_visit_team_id';

    public $timestamps = false;
}
