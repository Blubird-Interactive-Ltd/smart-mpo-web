<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationMaping extends Model
{
    protected $table = 'location_maping';

    protected $primaryKey = 'location_maping_id';

    public $timestamps = false;
}
