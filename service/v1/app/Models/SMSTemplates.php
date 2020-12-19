<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMSTemplates extends Model
{
    protected $table = 'sms_templates';

    protected $primaryKey = 'sms_template_id';

    public $timestamps = false;
}
