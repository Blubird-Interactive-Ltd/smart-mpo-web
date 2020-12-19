<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistTerritory extends Model
{
    protected $table = 'chemist_territories';

    protected $primaryKey = 'chemist_territory_id';

    public $timestamps = false;
}
