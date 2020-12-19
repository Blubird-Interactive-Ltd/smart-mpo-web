<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	public $timestamps = false;
	protected $table = 'regions';
    protected $primaryKey = 'region_id';
    protected $fillable = ['zone_id','region_name'];
}
