<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ChemistSpecialDay extends Model
{
    public $timestamps = false;
    protected $table = 'chemist_special_days';
    protected $primaryKey = 'chemist_special_day_id';
}
