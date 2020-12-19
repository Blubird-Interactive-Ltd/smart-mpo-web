<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressZip extends Model
{
    protected $table = 'address_zips';

    protected $primaryKey = 'address_zip_id';

    public $timestamps = false;
}
