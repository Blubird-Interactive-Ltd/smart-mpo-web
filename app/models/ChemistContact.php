<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ChemistContact extends Model
{
    public $timestamps = false;
    protected $table = 'chemist_contacts';
    protected $primaryKey = 'chemist_contact_id';
}
