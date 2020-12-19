<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDcrSample extends Model
{
    protected $table = 'doctor_dcr_sample_products';

    protected $primaryKey = 'doctor_dcr_sample_product_id';

    public $timestamps = false;
}
