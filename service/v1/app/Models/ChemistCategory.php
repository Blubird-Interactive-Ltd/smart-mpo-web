<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistCategory extends Model
{
    protected $table = 'chemist_categories';

    protected $primaryKey = 'chemist_category_id';

    public $timestamps = false;
}
