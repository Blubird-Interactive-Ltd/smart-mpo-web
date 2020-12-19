<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorEditRequest extends Model
{
    protected $table = 'doctor_edit_requests';

    protected $primaryKey = 'doctor_edit_request_id';

    public $timestamps = false;
}
