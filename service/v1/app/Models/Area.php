<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $primaryKey = 'area_id';

    public $timestamps = false;
}
