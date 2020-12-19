<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login_log extends Model
{
    protected $table = 'login_log';

    protected $primaryKey = 'login_log_id';

    public $timestamps = false;
}
