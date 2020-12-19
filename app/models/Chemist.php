<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Chemist extends Model
{
    protected $table = 'chemists';

    protected $primaryKey = 'chemist_id';

    public $timestamps = false;


    #one to many cat relation
    public function contacts()
    {
        return $this->hasMany(ChemistContact::class,'chemist_id');
    }

    #one to many cat relation
    public function chemist_address()
    {
        return $this->hasMany(ChemistAddress::class,'chemist_id');
    }
}
