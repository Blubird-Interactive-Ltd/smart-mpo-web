<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMSTemplates;
use App\Common;
use Hash;

/*
 * 1. SMS template
 * url: http://202.125.76.60/v1/template/sms_template
 * parameters: {token,sms_type,special_day_type_id}
 *
 * */

class TemplateController extends Controller
{
    public function index(){

    }

    public function smsTemplate(Request $request){
        if($request->token !=Common::TOKEN_TEMPLATE){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->sms_type ==''){
            return json_encode(['status'=>401,'reason'=>'SMS type required']);
        }
        if($request->special_day_type_id ==''){
            return json_encode(['status'=>401,'reason'=>'Special day type required']);
        }

        $sms_template = SMSTemplates::where('sms_type',$request->sms_type)->where('special_day_type_id',$request->special_day_type_id)->first();
        return json_encode(['status'=>200,'sms_template'=>$sms_template]);
    }
}
