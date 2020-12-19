<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Terget extends Model
{
	public $timestamps = false;
	protected $table = 'mpo_targets';
    protected $primaryKey = 'mpo_target_id';

    
}
