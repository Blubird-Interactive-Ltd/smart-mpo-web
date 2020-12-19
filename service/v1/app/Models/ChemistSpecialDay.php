<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistSpecialDay extends Model
{
    protected $table = 'chemist_special_days';

    protected $primaryKey = 'chemist_special_day_id';

    public $timestamps = false;
}
