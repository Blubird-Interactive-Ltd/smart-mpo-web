<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDcrProduct extends Model
{
    protected $table = 'doctor_dcr_products';

    protected $primaryKey = 'doctor_dcr_product_id';

    public $timestamps = false;
}
