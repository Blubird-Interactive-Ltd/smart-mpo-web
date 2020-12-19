<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common;

/*
 * 1. Get Active payment getway
 * url: http://202.125.76.60/v1
 * parameters: {}
 *
 * */

class HomeController extends Controller
{
    public function index(){
        //return 'welcome';

        /*$compressed   = gzcompress('Compress megjghjghj');
        $uncompressed = gzuncompress($compressed);

        return $uncompressed;*/
        //return base64_encode('12345678');

        $allData = array(
            'user_id'=>1,
            'name'=>'prince',
            'contact_no'=>array(
                array(
                    'contact_no' =>0123456
                ),
                array(
                    'contact_no' =>0123456
                )
            ),
            'email'=>'prince@bbil.com',
            'gender'=>'Male',
            'address_line1'=>'Shyamoli, Dhaka',
            'address_line2'=>'',
            'division'=>1,
            'district'=>2,
            'thana'=>1,
            'zip'=>'z12345',
            'qualification'=>'abc',
            'specialities'=>array(1,2,3),
            'class'=>1,
            'special_days'=>array(
                array(
                    'special_day_id' =>1,
                    'date' =>'1991-12-23',
                    'message'=>'Today is his birthday'
                ),
                array(
                    'special_day_id' =>2,
                    'date' =>'2017-03-12',
                    'message'=>'Today is his merrisage day'
                )
            ),
            'other_special_day'=>array(
                array(
                    'special_day' =>'day title1',
                    'date' =>'1991-12-23',
                    'message'=>'Today is his birthday'
                ),
                array(
                    'special_day' =>'day title2',
                    'date' =>'2017-03-12',
                    'message'=>'Today is his merrisage day'
                )
            ),
            'chamber_address'=>array(
                array(
                    'address_line1' =>'addr1',
                    'address_line2' =>'addr2',
                    'division'=>1,
                    'district'=>1,
                    'thana'=>1,
                    'zip'=>'123456',
                ),
                array(
                    'address_line1' =>'addr1.2',
                    'address_line2' =>'addr2.2',
                    'division'=>2,
                    'district'=>2,
                    'thana'=>2,
                    'zip'=>'123458',
                )
            )
        );

        return json_encode($allData);

    }

    public function testArray(){
        $allData = array(
            'user_id'=>1,
            'name'=>'prince',
            'contact_no'=>array(
                array(
                    'contact_no' =>0123456
                ),
                array(
                    'contact_no' =>0123456
                )
            ),
            'email'=>'prince@bbil.com',
            'gender'=>'Male',
            'address_line1'=>'Shyamoli, Dhaka',
            'address_line2'=>'',
            'division'=>1,
            'district'=>2,
            'thana'=>1,
            'zip'=>'z12345',
            'qualification'=>'abc',
            'specialities'=>array(1,2,3),
            'class'=>1,
            'special_days'=>array(
                array(
                    'special_day_id' =>1,
                    'date' =>'1991-12-23',
                    'message'=>'Today is his birthday'
                ),
                array(
                    'special_day_id' =>2,
                    'date' =>'2017-03-12',
                    'message'=>'Today is his merrisage day'
                )
            ),
            'other_special_day'=>array(
                array(
                    'special_day' =>'day title1',
                    'date' =>'1991-12-23',
                    'message'=>'Today is his birthday'
                ),
                array(
                    'special_day' =>'day title2',
                    'date' =>'2017-03-12',
                    'message'=>'Today is his merrisage day'
                )
            ),
            'chamber_address'=>array(
                array(
                    'address_line1' =>'addr1',
                    'address_line2' =>'addr2',
                    'division'=>1,
                    'district'=>1,
                    'thana'=>1,
                    'zip'=>'123456',
                ),
                array(
                    'address_line1' =>'addr1.2',
                    'address_line2' =>'addr2.2',
                    'division'=>2,
                    'district'=>2,
                    'thana'=>2,
                    'zip'=>'123458',
                )
            )
        );
    }
}
