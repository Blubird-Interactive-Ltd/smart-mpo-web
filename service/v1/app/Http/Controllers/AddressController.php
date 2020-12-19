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
 * 2. District By Division
 * url: http://satsai.com/dcr/v1/address/district_by_divion
 * parameters: {token}
 *
 * 3. Thana By District
 * url: http://satsai.com/dcr/v1/address/thana_by_district
 * parameters: {token}
 *
 * 4. Zip By Thana
 * url: http://satsai.com/dcr/v1/address/zip_by_thana
 * parameters: {token}
 *
 * */

class AddressController extends Controller
{
    public function index(){

    }

    public function addressList(Request $request){
        if($request->token !=Common::TOKEN_ADDRESS){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        $divisions = AddressDivision::get();
        $districts = AddressDistrict::get();
        $thanas = AddressThana::get();
        $zip = AddressZip::get();
        return json_encode(['status'=>200,'divisions'=>$divisions,'districts'=>$districts,'thanas'=>$thanas,'zip'=>$zip]);
    }

    public function districtByDivision(Request $request){
        if($request->token !=Common::TOKEN_ADDRESS){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->division_id ==''){
            return json_encode(['status'=>401,'reason'=>'Division ID required']);
        }

        $districts = AddressDistrict::where('division_id',$request->division_id)->get();
        return json_encode(['status'=>200,'districts'=>$districts]);
    }

    public function thanaByDistrict(Request $request){
        if($request->token !=Common::TOKEN_ADDRESS){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->district_id ==''){
            return json_encode(['status'=>401,'reason'=>'District ID required']);
        }

        $thanas = AddressThana::where('district_id',$request->district_id)->get();
        return json_encode(['status'=>200,'thanas'=>$thanas]);
    }

    public function zipByThana(Request $request){
        if($request->token !=Common::TOKEN_ADDRESS){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->thana_id ==''){
            return json_encode(['status'=>401,'reason'=>'Thana ID required']);
        }

        $zips = AddressZip::where('thana_id',$request->thana_id)->get();
        return json_encode(['status'=>200,'zips'=>$zips]);
    }
}
