<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    protected $table = 'classes';

    protected $primaryKey = 'class_id';

    public $timestamps = false;
}
