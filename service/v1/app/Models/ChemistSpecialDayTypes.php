<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistSpecialDayTypes extends Model
{
    protected $table = 'chemist_special_day_types';

    protected $primaryKey = 'chemist_special_day_type_id';

    public $timestamps = false;
}
