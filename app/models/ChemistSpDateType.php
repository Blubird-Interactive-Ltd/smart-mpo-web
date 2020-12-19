<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ChemistSpDateType extends Model
{
    public $timestamps = false;
    protected $table = 'chemist_special_day_types';
    protected $primaryKey = 'chemist_special_day_type_id';
}
