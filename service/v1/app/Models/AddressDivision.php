<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressDivision extends Model
{
    protected $table = 'address_divisions';

    protected $primaryKey = 'address_division_id';

    public $timestamps = false;
}
