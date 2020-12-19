<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistDcrGift extends Model
{
    protected $table = 'chemist_dcr_gifts';

    protected $primaryKey = 'chemist_dcr_gift_id';

    public $timestamps = false;
}
