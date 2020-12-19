<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $table = 'user_sessions';

    protected $primaryKey = 'user_session_id';

    public $timestamps = false;
}
