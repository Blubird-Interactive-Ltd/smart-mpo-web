<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistAddress extends Model
{
    protected $table = 'chemist_address';

    protected $primaryKey = 'chemist_address_id';

    public $timestamps = false;
}
