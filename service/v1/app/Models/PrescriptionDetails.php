<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDetails extends Model
{
    protected $table = 'prescription_details';

    protected $primaryKey = 'prescription_detail_id';

    public $timestamps = false;
}
