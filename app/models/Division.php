<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
	public $timestamps = false;
	protected $table = 'divisions';
    protected $primaryKey = 'division_id';
    protected $fillable = ['name'];
}
