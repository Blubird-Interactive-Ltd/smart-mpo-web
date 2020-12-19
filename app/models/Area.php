<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	public $timestamps = false;
	protected $table = 'areas';
    protected $primaryKey = 'area_id';
    protected $fillable = ['region_id','area_name'];
}
