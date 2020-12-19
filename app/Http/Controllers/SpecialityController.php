<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\models\Speciality;
use App\models\SpecialDay;
use Session;
use DB;
use Auth;
use App\Utility;

class SpecialityController extends Controller
{

	/**
     * Doctor Class view function.
    */
    public function DoctorSpeciality()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),47)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        return view('doctor.doctorSpeciality',$data);
    }

    /**
     * Doctor Class view function.
    */
    public function getDoctorSpeciality()
    {	
    	$result = Speciality::orderBy('speciality_id','DESC')->get();
    	return ['status'=>200,'reason'=>'Success','val'=>$result];
    }

    /**
     * Doctor Class Store function.
    */
    public function DoctorSpecialityStore(Request $request)
    {

    $validator = Validator::make($request->all(), ['name' => 'required']);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

	    	try{
	        DB::beginTransaction();
	        	
		        $name = Utility::sanitize_string($request->name);

		    	$obj = new Speciality;
		    	$obj->name = $name;
		    	$result = $obj->save();
		    	if($result){
		    		return ['status'=>200,'reason'=>'Doctor Specialty added successfully','val'=>'Success'];
		    	}
		    }catch(\Exception $e){ 
	            DB::rollback();
	        return ['status'=>404, 'reason'=>'Your data is corrupted !'];
	    	}

        }
    }     

    /**
     * Doctor Class Edit val function.
    */
    public function DoctorGetEditVal(Request $request)
    {
    	$id = $request->id;
    	$result = Speciality::where('speciality_id',$id)->first();
    	return ['status'=>200,'reason'=>'success','val'=>$result];
    }

    /**
     * Doctor Class Update function.
    */
    public function DoctorSpecialityUpdate(Request $request)
    { 
    	$validator = Validator::make($request->all(), [ 'name' => 'required' ]);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

	    	try{
	        DB::beginTransaction();
	        	
		        $name = Utility::sanitize_string($request->name);
		        $id = $request->id;

		    	$obj = Speciality::find($id);
		    	$obj->name = $name;
		    	$result = $obj->save();
		    	if($result){
		    		return ['status'=>200,'reason'=>'Doctor Specialty updated successfully','val'=>'Success'];
		    	}
		    }catch(\Exception $e){ 
	            DB::rollback();
	        return ['status'=>404, 'reason'=>'Your data is corrupted !'];
	    	}

        }  
    }  


    /**
     * Doctor Class Update function.
    */
    public function delDoctorSpeciality(Request $request)
    {
    	try{
        DB::beginTransaction();
	    	$id = $request->id;
	    	$status = $request->status;
	    	if($status == 2){ $reson = 'Doctor Specialty inactive successfully'; }
	    	if($status == 1){ $reson = 'Doctor Specialty active successfully'; }

	    	$obj = Speciality::find($id);
	    	if($status == 2){
		    	$obj->status = 'inactive';
	    	}
	    	if($status == 1){
		    	$obj->status = 'active';
	    	}
	    	if($obj->save()){
	    		return ['status'=>200,'reason'=>$reson,'val'=>'Success'];
	    	}
	    }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reason'=>$e->getMessage()];
    	}
    }





    /**
     * Doctor Speciality view function.
    */
    public function specialDay()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),43)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        return view('doctor.SpecialDay',$data);
    }

    /**
     * Doctor Speciality day get function.
    */
    public function getDoctorSpecialDay()
    {   
        $result = SpecialDay::orderBy('system_special_day_id','DESC')->get();
        return ['status'=>200,'reason'=>'Success','val'=>$result];
    }

    /**
     * Doctor Speciality Store function.
    */
    public function SpecialDayStore(Request $request)
    {

    $validator = Validator::make($request->all(), ['name' => 'required','date' => 'required']);

    if (!$validator->passes()) {    
        return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

            try{
            DB::beginTransaction();
                
                $name = Utility::sanitize_string($request->name);
                $message = Utility::sanitize_string($request->remark);
                $date = $request->date; // Utility::databaseDate($request->date);
                //$data = date('Y-m-d', strtotime($request->date));

                $obj = new SpecialDay;
                $obj->name = $name;
                $obj->message = $message;
                $obj->date = $date;
                $result = $obj->save();
                if($result){
                    return ['status'=>200,'reason'=>'Special date added successfully','val'=>'Success'];
                }
            }catch(\Exception $e){ 
                DB::rollback();
            return ['status'=>404, 'reason'=>'Your data formate not correct !'];
            }

        }
    } 


    /**
     * Doctor special date Edit val function.
    */
    public function getSpecialDayVal(Request $request)
    {
        $id = $request->id;
        $result = SpecialDay::where('system_special_day_id',$id)->first();
        return ['status'=>200,'reason'=>'success','val'=>$result];
    }

    /**
     * Doctor special date Update function.
    */
    public function SpecialDayUpdate(Request $request)
    { 
        $validator = Validator::make($request->all(), ['name' => 'required','date' => 'required']);

    if (!$validator->passes()) {    
        return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

            try{
            DB::beginTransaction();
                
                $name = Utility::sanitize_string($request->name);
                $message = Utility::sanitize_string($request->remark);
                $date = $request->date; // Utility::databaseDate($request->date);
                $id = $request->id;

                $obj = SpecialDay::find($id);
                $obj->name = $name;
                $obj->message = $message;
                $obj->date = $date;
                $result = $obj->save();
                if($result){
                    return ['status'=>200,'reason'=>'Special date updated successfully','val'=>'Success'];
                }
            }catch(\Exception $e){ 
                DB::rollback();
            return ['status'=>404, 'reason'=>'Your data formate not correct !'];
            }

        }  
    }


    /**
     * Special date active inactive
    */
    public function delSpecialDay(Request $request)
    {
        try{
        DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;
            if($status == 2){ $reson = 'Special date inactive successfully'; }
            if($status == 1){ $reson = 'Special date active successfully'; }

            $obj = SpecialDay::find($id);
            if($status == 2){
                $obj->status = 'inactive';
            }
            if($status == 1){
                $obj->status = 'active';
            }
            if($obj->save()){
                return ['status'=>200,'reason'=>$reson,'val'=>'Success'];
            }
        }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reason'=>$e->getMessage()];
        }
    }





}
