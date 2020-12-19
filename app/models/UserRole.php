<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	public $timestamps = false;
	protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $fillable = [ 'role_id','name'];
}
