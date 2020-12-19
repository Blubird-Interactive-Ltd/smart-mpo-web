<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\Division;

class Zone extends Model
{
	public $timestamps = false;
	protected $table = 'zones';
    protected $primaryKey = 'zone_id';
    protected $fillable = ['division_id','zone_name'];
}
