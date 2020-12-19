<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';

    protected $primaryKey = 'prescription_id';

    public $timestamps = false;

    #one to many cat relation
    public function products()
    {
        return $this->hasMany(PrescriptionDetail::class,'prescription_id');
    }

    #one to many cat relation
    public function images()
    {
        return $this->hasMany(PrescriptionImage::class,'prescription_id');
    }
}
