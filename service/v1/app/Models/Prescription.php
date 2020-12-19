<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';

    protected $primaryKey = 'prescription_id';

    public $timestamps = false;
}
