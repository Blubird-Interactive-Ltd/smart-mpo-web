<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Common;
use Hash;

/*
 * 1. User search
 * url: http://202.125.76.60/v1/user/search
 * parameters: {token,oauth_token,name}
 *
 * */

class UserController extends Controller
{
    public function index(){
        //
    }

    public function userSearch(Request $request){
        if($request->token !=Common::TOKEN_USER){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::select('users.*')->where('users.active_oauth_token',$request->oauth_token)
            ->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        if($request->name ==''){
            return json_encode(['status'=>200,'data'=>[]]);
        }
        if($user->role_id==5){ // For MPO. Get zsm id
            $am = User::select('users.*','zsm.id as zsm_id')->where('users.id',$user->parent_id)
                ->join('users as rsm','rsm.id','=','users.parent_id')
                ->join('users as zsm','zsm.id','=','rsm.parent_id')
                ->first();
            $zsm_id = $am->zsm_id;
        }
        else{ // For AM. Get zsm id
            $am = User::select('users.*','zsm.id as zsm_id')->where('users.id',$user->id)
                ->join('users as rsm','rsm.id','=','users.parent_id')
                ->join('users as zsm','zsm.id','=','rsm.parent_id')
                ->first();
            $zsm_id = $am->zsm_id;
        }

        // Get all rsm ids associate with the zsm
        $all_rsm = User::select('id')->where('parent_id',$zsm_id)->orderBy('id','asc')->pluck('id')->toArray();

        // Get all am ids associate with the all_rsm
        $all_am = User::select('id')->whereIn('parent_id',$all_rsm)->orderBy('id','asc')->pluck('id')->toArray();

        $rsms = User::select('users.id','users.first_name', 'users.last_name','roles.name as designation')
            ->Where('first_name', 'like', '%'.$request->name.'%')
            ->whereIn('id',$all_rsm)
            ->where('status','active')
            //->orWhere('last_name', 'like','%'. $request->name.'%')
            ->join('roles','roles.role_id','=','users.role_id')
            ->get();

        $ams = User::select('users.id','users.first_name', 'users.last_name','roles.name as designation')
            ->Where('first_name', 'like', '%'.$request->name.'%')
            ->whereIn('parent_id',$all_rsm)
            ->where('id','!=',$user->id)
            ->where('status','active')
            //->orWhere('last_name', 'like','%'. $request->name.'%')
            ->join('roles','roles.role_id','=','users.role_id')
            ->get();

        $mpos = User::select('users.id','users.first_name', 'users.last_name','roles.name as designation')
            ->Where('first_name', 'like', '%'.$request->name.'%')
            ->whereIn('parent_id',$all_am)
            ->where('id','!=',$user->id)
            ->where('status','active')
            //->orWhere('last_name', 'like','%'. $request->name.'%')
            ->join('roles','roles.role_id','=','users.role_id')
            ->get();

        $merged1 = $ams->merge($rsms);
        $group1 = $merged1->all();

        $merged2 = $mpos->merge($group1);
        $group2 = $merged2->all();
        return json_encode(['status'=>200,'data'=>$group2]);
    }

}
