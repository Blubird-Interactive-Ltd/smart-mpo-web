<?php

namespace App\Http\Controllers;

use App\Models\DoctorDcr;
use App\Models\MPOTarget;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Common;
use DB;

/*
 * 1. Get all target
 * url: http://satsai.com/dcr/v1/chemist_dcr/create
 * parameters: {token,gzcompress(data)}
 * data = array(oauth_token,doctor_id,user_id,remark,time,products=[{"chemist_id":1,"product_id":2},{"chemist_id":2,"product_id":10}])
 *
 * */

class TargetController extends Controller
{
    public function index(){

    }
}
