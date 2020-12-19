<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ChemistTerritory extends Model
{
    public $timestamps = false;
    protected $table = 'chemist_territories';
    protected $primaryKey = 'chemist_territory_id';
}
