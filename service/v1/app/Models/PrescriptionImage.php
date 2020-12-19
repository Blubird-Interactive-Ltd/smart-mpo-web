<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionImage extends Model
{
    protected $table = 'prescription_images';

    protected $primaryKey = 'prescription_image_id';

    public $timestamps = false;
}
