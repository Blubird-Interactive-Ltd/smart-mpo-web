<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\AddressDivision;
use App\Models\AddressDistrict;
use App\Models\AddressThana;
use App\Models\AddressZip;
use App\Common;
use Hash;

/*
 * 1. Address list
 * url: http://satsai.com/dcr/v1/address/address_list
 * parameters: {token}
 *
 * */

class FCMController extends Controller
{
    public function index(){

    }

    public function pushNotification(Request $request){
        #API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAA9SGTR8c:APA91bHH8Koe5tBPK3sg1v2lXXo5kQAmOQSh8Jxlgcf5eLLWTnVhaIMdulckWWXEE4PE0QFDJRHtPWwz5e6t2sEZ-Q2wvWiC8WM2bAOSVyTHG2H3ns9e42zjMJbf1u3Lv8ePKBPozpBU' );
        $registrationIds = $request->id;
        #prep the bundle
        $msg = array
        (
            'body' 	=> $request->body_message,
            'title'	=> $request->message_title,
            'icon'	=> 'myicon',/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );
        $fields = array
        (
            'to'		=> $registrationIds,
            'notification'	=> $msg
        );


        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        #Echo Result Of FireBase Server
        echo $result;
    }
}
