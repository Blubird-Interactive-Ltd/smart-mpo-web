<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
	public $timestamps = false;
	protected $table = 'territories';
    protected $primaryKey = 'territory_id';
    protected $fillable = ['thana_id','name'];
}
