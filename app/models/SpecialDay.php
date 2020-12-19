<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SpecialDay extends Model
{
    protected $table = 'system_special_days';

    protected $primaryKey = 'system_special_day_id';

    public $timestamps = false;
}
