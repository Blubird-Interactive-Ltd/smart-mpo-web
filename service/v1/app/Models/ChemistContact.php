<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistContact extends Model
{
    protected $table = 'chemist_contacts';

    protected $primaryKey = 'chemist_contact_id';

    public $timestamps = false;
}
