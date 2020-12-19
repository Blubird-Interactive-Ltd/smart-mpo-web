<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chemist extends Model
{
    protected $table = 'chemists';

    protected $primaryKey = 'chemist_id';

    public $timestamps = false;
}
