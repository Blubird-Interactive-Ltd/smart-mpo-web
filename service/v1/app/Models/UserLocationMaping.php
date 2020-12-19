<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocationMaping extends Model
{
    protected $table = 'user_location_maping';

    protected $primaryKey = 'user_location_maping_id';

    public $timestamps = false;
}
