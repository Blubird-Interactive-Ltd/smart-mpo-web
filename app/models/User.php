<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\UserRole;

class User extends Model
{
	public $timestamps = false;
	protected $table = 'users';
    protected $primaryKey = 'id';
    
    //protected $fillable = [ 'role_id','name'];

    #one to many cat relation
   	public function userRole()
    {
        return $this->hasOne(UserRole::class,'role_id');
    }
}
