<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    protected $table = 'territories';

    protected $primaryKey = 'territory_id';

    public $timestamps = false;
}
