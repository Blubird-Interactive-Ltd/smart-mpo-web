<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Territory;
use App\Models\User;
use App\Common;
use Hash;

/*
 * 1. Territory list
 * url: http://satsai.com/dcr/v1/territory/list
 * parameters: {token,oauth_token}
 *
 * */

class TerritoryController extends Controller
{
    public function index(){

    }

    public function territoryList(Request $request){
        if($request->token !=Common::TOKEN_TERRITORY){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        if($user->role_id==5){
            /*$am = User::select('users.*','zsm.id as zsm_id')->where('users.id',$user->parent_id)
                ->join('users as rsm','rsm.id','=','users.parent_id')
                ->join('users as zsm','zsm.id','=','rsm.parent_id')
                ->first();
            $zsm_id = $am->zsm_id;
            // Get all rsm ids associate with the zsm
            $all_rsm = User::select('id')->where('parent_id',$zsm_id)->orderBy('id','asc')->pluck('id')->toArray();
            // Get all am ids associate with the all_rsm
            $all_am = User::select('id')->whereIn('parent_id',$all_rsm)->orderBy('id','asc')->pluck('id')->toArray();*/

            $all_am = User::select('id')->where('users.id',$user->parent_id)->pluck('id')->toArray();
            $territories = User::select('territories.*')->whereIn('parent_id',$all_am)
                ->join('territories','territories.territory_id','=','users.location_id')
                ->where('territories.status','Active')
                ->groupBy('territories.name')
                ->get();
        }
        else{
            $territories = User::select('territories.*')->where('parent_id',$user->id)
                ->join('territories','territories.territory_id','=','users.location_id')
                ->where('territories.status','Active')
                ->groupBy('territories.name')
                ->get();
        }
        return json_encode(['status'=>200,'reason'=>'','data'=>$territories]);
    }
}
