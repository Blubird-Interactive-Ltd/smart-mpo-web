<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ChemistAddress extends Model
{
    public $timestamps = false;
    protected $table = 'chemist_address';
    protected $primaryKey = 'chemist_address_id';
}
