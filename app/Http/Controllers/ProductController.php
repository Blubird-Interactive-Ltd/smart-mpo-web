<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;
use App\Utility;
use App\models\Product;
use DB;
use Auth;


class ProductController extends Controller
{

    /**
     * Product View function.
    */
    public function index()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),5)){
            return redirect('404_page');
        }
        $data['page'] = 'Product';
        return view('product.manage_product',$data);
    }
	/**
     * Product List By Ajax function.
    */
    public function getProducts(Request $request)
    {
    	$result = Product::orderBy('product_id','DESC')->paginate(100);
        $data['pagination'] = $result->render();
    	return ['status'=>200,'reason'=>'','val'=>$result,'pagination'=>view('pagination',$data)->render()];
    }

    /**
     * Product Store By Ajax function.
    */
    public function ProductStore(Request $request)
    {
    	$result = Input::all();
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'size' => 'required',
            'price' => 'required',
            'vat' => 'required',
        ]);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

    	try{
    	    $duplicate_product = Product::where('product_code',$request->code)->first();
            if(!empty($duplicate_product)){
                return ['status'=>401,'reason'=>'Duplicate product code'];
            }

            DB::beginTransaction();
        	
	        $name = $request->name;
	        $code = $request->code;
	        $size = $request->size;
	        $price = $request->price;
	        $vat = $request->vat;

	    	$obj = new Product;
	    	$obj->name = $name;
	    	$obj->product_code = $code;
	    	$obj->packet_size = $size;
	    	$obj->price_tp = $price;
	    	$obj->price_vat = $vat;
	    	$obj->created_by = 20;
	    	$result = $obj->save();
	    	if($result){
	    		return ['status'=>200,'reason'=>'Successfully saved'];
	    	}
	    }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>200, 'reson'=>$e->getMessage()];
    	}

        }    
    }


    /**
     * Product Delete By Ajax function.
    */
    public function ProductDelete(Request $request)
    {
    	try{
        DB::beginTransaction();
	    	$id = $request->id;
	    	$status = $request->status;

	    	$obj = Product::find($id);
	    	if($status == 1){
	    	    $status_text = 'inactivated';
		    	$obj->status = 'inactive';
	    	}
	    	if($status == 2){
                $status_text = 'activated';
		    	$obj->status = 'active';
	    	}
	    	if($obj->save()){
	    		return ['status'=>200,'reason'=>'Product '.$status_text.' successfully','val'=>'Success'];
	    	}
	    }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reson'=>$e->getMessage()];
    	}
    }
    /**
     * Product Edit vat get By Ajax function.
    */
    public function getEditVal(Request $request)
    {
    	$id = $request->id;
    	$result = Product::where('product_id',$id)->first();
    	return ['status'=>200,'reason'=>'success','val'=>$result];
    }
    /**
     * Product Edit vat get By Ajax function.
    */
    public function ProductUpdate(Request $request)
    {
    	$result = Input::all();
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'size' => 'required',
            'price' => 'required',
            'vat' => 'required',
        ]);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

    	try{
            $duplicate_product = Product::where('product_code',$request->code)->first();
            if(!empty($duplicate_product)){
                if($duplicate_product->product_id != $request->id){
                    return ['status'=>401,'reason'=>'Duplicate product code'];
                }
            }

            DB::beginTransaction();
        	
	        $name = $request->name;
	        $code = $request->code;
	        $size = $request->size;
	        $price = $request->price;
	        $vat = $request->vat;
	        $id = $request->id;

	    	$obj = Product::find($id);
	    	$obj->name = $name;
	    	$obj->product_code = $code;
	    	$obj->packet_size = $size;
	    	$obj->price_tp = $price;
	    	$obj->price_vat = $vat;
	    	$obj->created_by = 20;
	    	$result = $obj->save();
	    	if($result){
	    		return ['status'=>200,'reason'=>'Successfully saved','val'=>'Success'];
	    	}
	    }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>200, 'reson'=>$e->getMessage()];
    	}

        }    
    }
}
