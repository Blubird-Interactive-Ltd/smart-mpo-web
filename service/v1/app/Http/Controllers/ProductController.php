<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Common;
use Hash;

/*
 * 1. Product list
 * url: http://202.125.76.60/v1/product/list
 * parameters: {token,oauth_token}
 *
 * 2. Product search
 * url: http://202.125.76.60/v1/product/search
 * parameters: {token,oauth_token,product_name}
 *
 * */

class ProductController extends Controller
{
    public function index(){
    }

    public function productList(Request $request){
        if($request->token !=Common::TOKEN_PRODUCT){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $products = Product::where('status','active')->get();
        return json_encode(['status'=>200,'reason'=>'','data'=>$products]);
    }

    public function productSearch(Request $request){
        if($request->token !=Common::TOKEN_PRODUCT){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            //return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $products = Product::where('name','like','%'. $request->product_name.'%')->where('status','active')->get();
        return json_encode(['status'=>200,'reason'=>'','data'=>$products]);
    }
}
