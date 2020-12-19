<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressDistrict extends Model
{
    protected $table = 'address_districts';

    protected $primaryKey = 'address_district_id';

    public $timestamps = false;
}
