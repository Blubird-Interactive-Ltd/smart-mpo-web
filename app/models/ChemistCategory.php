<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ChemistCategory extends Model
{
	public $timestamps = false;
	protected $table = 'chemist_categories';
    protected $primaryKey = 'chemist_category_id';
    protected $fillable = ['name'];
}
