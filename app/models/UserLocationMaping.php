<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\UserRole;

class UserLocationMaping extends Model
{
    public $timestamps = false;
    protected $table = 'user_location_maping';
    protected $primaryKey = 'user_location_maping_id';
}
