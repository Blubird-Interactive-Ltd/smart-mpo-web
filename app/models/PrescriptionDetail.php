<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    protected $table = 'prescription_details';

    protected $primaryKey = 'prescription_detail_id';

    public $timestamps = false;
}
