<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RoleFeature extends Model
{
    public $timestamps = false;
    protected $table = 'role_features';
    protected $primaryKey = 'role_permission_id';
}
