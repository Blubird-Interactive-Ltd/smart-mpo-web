<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistDcrProduct extends Model
{
    protected $table = 'chemist_dcr_products';

    protected $primaryKey = 'chemist_dcr_product_id';

    public $timestamps = false;
}
