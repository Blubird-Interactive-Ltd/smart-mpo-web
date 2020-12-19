<?php

namespace App\Http\Controllers;

use App\models\ClassType;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;
use App\Utility;
use DB;
use Auth;

class ClassController extends Controller
{

    /**
     * Chemist Class view function.
    */
    public function chemistClass()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),55)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        return view('classes.chemistClass',$data);
    }

    /**
     * Chemist Class view function.
    */
    public function getChemistClass()
    {	
    	$result = ClassType::Where('type',2)->orderBy('class_id','DESC')->get();
    	return ['status'=>200,'reason'=>'Operation Success','val'=>$result];
    }

    /**
     * Chemist Class Store function.
    */
    public function ChemistClassStore(Request $request)
    {

    $validator = Validator::make($request->all(), ['name' => 'required']);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

	    	try{
	        DB::beginTransaction();
	        	
		        $name = Utility::sanitize_string($request->name);

		    	$obj = new ClassType;
		    	$obj->class_name = $name;
		    	$obj->type = 2;
		    	$result = $obj->save();
		    	if($result){
		    		return ['status'=>200,'reason'=>'Chemist class added successfully','val'=>'Success'];
		    	}
		    }catch(\Exception $e){ 
	            DB::rollback();
	        return ['status'=>404, 'reason'=>'You data is corrupted !'];
	    	}

        }
    }     

    /**
     * Chemist Class Edit val function.
    */
    public function ChemistGetEditVal(Request $request)
    {
    	$id = $request->id;
    	$result = ClassType::where('class_id',$id)->first();
    	return ['status'=>200,'reason'=>'success','val'=>$result];
    }

    /**
     * Chemist Class Update function.
    */
    public function ChemistClassUpdate(Request $request)
    { 
    	$validator = Validator::make($request->all(), [ 'name' => 'required' ]);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

	    	try{
	        DB::beginTransaction();
	        	
		        $name = Utility::sanitize_string($request->name);
		        $id = $request->id;

		    	$obj = ClassType::find($id);
		    	$obj->class_name = $name;
		    	$result = $obj->save();
		    	if($result){
		    		return ['status'=>200,'reason'=>'Chemist class updated successfully','val'=>'Success'];
		    	}
		    }catch(\Exception $e){ 
	            DB::rollback();
	        return ['status'=>404, 'reason'=>'You data is corrupted !'];
	    	}

        }  
    }  


    /**
     * Chemist Class Update function.
    */
    public function delChemistClass(Request $request)
    {
    	try{
        DB::beginTransaction();
	    	$id = $request->id;
	    	$status = $request->status;
	    	if($status == 2){ $reason = 'Chemist inactive successfully'; }
	    	if($status == 1){ $reason = 'Chemist active successfully'; }
	    	$obj = ClassType::find($id);
	    	if($status == 2){
		    	$obj->status = 'inactive';
	    	}
	    	if($status == 1){
		    	$obj->status = 'active';
	    	}
	    	if($obj->save()){
	    		return ['status'=>200,'reason'=>$reason,'val'=>'Success'];
	    	}
	    }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reason'=>$e->getMessage()];
    	}
    }




    /**
     * Doctor Class view function.
    */
    public function DoctorClass()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),51)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        return view('classes.DoctorClass',$data);
    }

    /**
     * Doctor Class view function.
    */
    public function getDoctorClass()
    {	
    	$result = ClassType::Where('type',1)->orderBy('class_id','DESC')->get();
    	return ['status'=>200,'reason'=>'Operation Success','val'=>$result];
    }

    /**
     * Doctor Class Store function.
    */
    public function DoctorClassStore(Request $request)
    {

    $validator = Validator::make($request->all(), ['name' => 'required']);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

	    	try{
	        DB::beginTransaction();
	        	
		        $name = Utility::sanitize_string($request->name);

		    	$obj = new ClassType;
		    	$obj->class_name = $name;
		    	$obj->type = 1;
		    	$result = $obj->save();
		    	if($result){
		    		return ['status'=>200,'reason'=>'Doctor class added successfully','val'=>'Success'];
		    	}
		    }catch(\Exception $e){ 
	            DB::rollback();
	        return ['status'=>404, 'reason'=>'You data is corrupted !'];
	    	}

        }
    }     

    /**
     * Doctor Class Edit val function.
    */
    public function DoctorGetEditVal(Request $request)
    {
    	$id = $request->id;
    	$result = ClassType::where('class_id',$id)->first();
    	return ['status'=>200,'reason'=>'success','val'=>$result];
    }

    /**
     * Doctor Class Update function.
    */
    public function DoctorClassUpdate(Request $request)
    { 
    	$validator = Validator::make($request->all(), [ 'name' => 'required' ]);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

	    	try{
	        DB::beginTransaction();
	        	
		        $name = Utility::sanitize_string($request->name);
		        $id = $request->id;

		    	$obj = ClassType::find($id);
		    	$obj->class_name = $name;
		    	$result = $obj->save();
		    	if($result){
		    		return ['status'=>200,'reason'=>'Doctor class updated successfully','val'=>'Success'];
		    	}
		    }catch(\Exception $e){ 
	            DB::rollback();
	        return ['status'=>404, 'reason'=>'You data is corrupted !'];
	    	}

        }  
    }  


    /**
     * Doctor Class Update function.
    */
    public function delDoctorClass(Request $request)
    {
    	try{
        DB::beginTransaction();
	    	$id = $request->id;
	    	$status = $request->status;
	    	if($status == 2){ $reason = 'Doctor inactive successfully'; }
	    	if($status == 1){ $reason = 'Doctor active successfully'; }

	    	$obj = ClassType::find($id);
	    	if($status == 2){
		    	$obj->status = 'inactive';
	    	}
	    	if($status == 1){
		    	$obj->status = 'active';
	    	}
	    	if($obj->save()){
	    		return ['status'=>200,'reason'=>$reason,'val'=>'Success'];
	    	}
	    }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reason'=>$e->getMessage()];
    	}
    }
    } // End class controller

