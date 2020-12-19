<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MPOTarget extends Model
{
    protected $table = 'mpo_targets';

    protected $primaryKey = 'mpo_target_id';

    public $timestamps = false;
}
