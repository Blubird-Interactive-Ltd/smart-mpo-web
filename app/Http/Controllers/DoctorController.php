<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;
use App\Utility;
use App\models\Doctor;
use App\models\DoctorHomeAddress;
use App\models\DoctorContact;
use App\models\DoctorSpeciality;
use App\models\DoctorSpecialDay;
use App\models\Doctor_chamber;
use App\models\DoctorSpDayType;
use DB;
use Auth;

class DoctorController extends Controller
{

    /**
     * Doctor Manage View function.
    */
    public function index(){
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),9)){
            return redirect('404_page');
        }

        $data['page'] = 'Doctor';

        $data['divisions'] = DB::table('address_divisions')->get();
        $data['specialities'] = DB::table('specialities')->where('status','active')->get();
        $data['classes'] = DB::table('classes')->where('status','active')->get();
        $data['special_day_types'] = DB::table('doctor_special_day_types')->where('status','active')->get();
    	return view('doctor.manage_doctor',$data);
    }

    /**
     * Doctor Data return View function.
    */
    public function getDoctor(Request $request){
        if ($request->search_string !='') {
            $doctors = Doctor::select('doctors.*','users.first_name','users.last_name','classes.class_name')
                ->leftJoin('classes','doctors.class_id','classes.class_id')
                ->leftJoin('users','users.id','doctors.created_by')
                ->orderBy('doctors.doctor_id','DESC')
                ->where('doctors.status','!=','rejected')
                ->where('doctors.name','like','%'.$request->search_string.'%')
                ->paginate(100);
        }
        else{
            $doctors = Doctor::select('doctors.*','users.first_name','users.last_name','classes.class_name')
                ->leftJoin('classes','doctors.class_id','classes.class_id')
                ->leftJoin('users','users.id','doctors.created_by')
                ->orderBy('doctors.doctor_id','DESC')
                ->where('doctors.status','!=','rejected')
                ->paginate(100);
        }

        foreach($doctors as $key=>$value){
            $contacts = DoctorContact::where('doctor_id',$value->doctor_id)->get();
            $specialities = DoctorSpeciality::where('doctor_id',$value->doctor_id)
                ->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
                ->get();
            $doctors[$key]->contacts = $contacts;
            $doctors[$key]->doctor_specialities = $specialities;
        }
        $data['pagination'] = $doctors->render();
        return json_encode(['status'=>200,'val'=>$doctors,'pagination'=>view('pagination',$data)->render()]);
    }

    /**
     * Doctor Store return View function.
    */
    public function doctorStore(Request $request){
    	$doctor = Input::all();
    	$result = Input::all();
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'qualification' => 'required',

        ]);

    if (!$validator->passes()) {	
		return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{
    	//try{
        DB::beginTransaction();
        	
	        $name = Utility::sanitize_string($request->name);
	        $email = $request->email;
	        $gender = Utility::sanitize_string( $request->gender);
	        $price = Utility::sanitize_decimal( $request->price);
	        $class = Utility::sanitize_number( $request->class);
	        $qualification = Utility::sanitize_string($request->qualification);

	        $home_address1 = Utility::sanitize_string($request->home_address1);
	        //$address2 = Utility::sanitize_string($request->address2);
	        $home_division = Utility::sanitize_number($request->home_division);
	        $home_district = Utility::sanitize_number($request->home_district);
	        $home_thana = Utility::sanitize_number($request->home_thana);
	        $home_zip = Utility::sanitize_number($request->home_zip);
	        $honorium = Utility::sanitize_number($request->honorarium);

	        //Doctor store
		   	$doctor = NEW Doctor();
	        $doctor->name = $name;
	        $doctor->email = implode(",",$email);
	        $doctor->created_by = 1;
	        $doctor->qualification = $qualification;
	        $doctor->class_id = $class;
	        $doctor->gender = $gender;
	        $doctor->other_special_day = '';
	        $doctor->honorium = $honorium;
	        $doctor->save();
	        $doctor_id = $doctor->doctor_id;

		    /*
	         * Adding doctor home addresses
	        */
	        $homeAddress = NEW DoctorHomeAddress();
	        $homeAddress->doctor_id = $doctor_id;
	        $homeAddress->address_line1	 = $home_address1;
	        $homeAddress->address_line2	 = '';
	        $homeAddress->division	 = $home_division;
	        $homeAddress->district	 = $home_district;
	        $homeAddress->thana	 = $home_thana;
	        $homeAddress->zip	 = $home_zip;
	        $homeAddress->save();

		    /*
	         * Adding doctor contact numbers
	        */
	        $contact_nos = $request->contact;
	        foreach($contact_nos as $key => $contact_no){
	            if($contact_no !=''){
                    $contact = NEW DoctorContact();
                    $contact->doctor_id = $doctor_id;
                    $contact->contact_no = $contact_no;
                    $contact->save();
                }
	        }

	    /*
         * Adding doctor specialities
        */
        $doctor_specialities = $request->speciality;
        foreach($doctor_specialities as $key => $ds){
            if($request->speciality[$key] !=''){
                $speciality = NEW DoctorSpeciality();
                $speciality->doctor_id = $doctor_id;
                $speciality->speciality_id = $request->speciality[$key];
                $speciality->save();
            }
        }

        /*
         * Adding doctor special days
        */
        $special_days = $request->special_day_type;
        $special_day_dates = $request->special_day_date;
        if(!empty($special_days)) {
            foreach($special_days as $key => $special_day){
                $specialDay = NEW DoctorSpecialDay();
                $specialDay->doctor_id = $doctor_id;
                $specialDay->special_day_id = $request->special_day_type[$key];
                $specialDay->message = $request->remark[$key];
                $specialDay->date = date('Y-m-d', strtotime($special_day_dates[$key]));
                $specialDay->save();
            }
        }

        /*
         * Adding doctor chamber addresses
        */
        $chamber_address = $request->chember_address1;
        foreach($chamber_address as $key => $chamber_addr){
            if($chamber_address[$key]!='') {
                $chamber = NEW Doctor_chamber();
                $chamber->doctor_id = $doctor_id;
                $chamber->address_line1 = $chamber_address[$key];
                $chamber->address_line2 = '';
                $chamber->division = $request->chamber_division[$key];
                $chamber->district = $request->chamber_district[$key];
                $chamber->thana = $request->chamber_thana[$key];
                $chamber->zip = $request->chamber_zip[$key];
                $chamber->save();
            }
        }
		return ['status'=>200,'reason'=>'Doctor successfully saved','val'=>'Success'];

	    /*}catch(\Exception $e){
            DB::rollback();
        return ['status'=>401, 'reson'=>$e->getMessage()];
    	}*/
    }
		//return json_encode(['val'=>$doctor]);
}

    public function doctorDetails(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Doctor';

        $data['doctor'] = Doctor::select('doctors.*','classes.class_name')
            ->with('contacts')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->where('doctor_id',$request->id)
            ->first();

        $special_days = DoctorSpecialDay::where('doctor_id',$data['doctor']->doctor_id)
            ->join('doctor_special_day_types','doctor_special_day_types.doctor_special_day_type_id','=','doctor_special_days.special_day_id')
            ->get();

        $specialities = DoctorSpeciality::where('doctor_id',$data['doctor']->doctor_id)
            ->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
            ->get();

        $chambers_address = Doctor_chamber::where('doctor_id',$data['doctor']->doctor_id)
            ->join('address_divisions','address_divisions.division_id','=','doctor_chambers.division')
            ->leftJoin('address_districts','address_districts.district_id','=','doctor_chambers.district')
            ->leftJoin('address_thanas','address_thanas.thana_id','=','doctor_chambers.thana')
            ->leftJoin('address_zips','address_zips.zip_id','=','doctor_chambers.zip')
            ->get();
        $home_address = DoctorHomeAddress::where('doctor_id',$data['doctor']->doctor_id)
            ->join('address_divisions','address_divisions.division_id','=','doctor_home_address.division')
            ->leftJoin('address_districts','address_districts.district_id','=','doctor_home_address.district')
            ->leftJoin('address_thanas','address_thanas.thana_id','=','doctor_home_address.thana')
            ->leftJoin('address_zips','address_zips.zip_id','=','doctor_home_address.zip')
            ->get();

        $data['doctor']->special_days = $special_days;
        $data['doctor']->doctor_specialities = $specialities;
        $data['doctor']->chambers = $chambers_address;
        $data['doctor']->home_address = $home_address;
        return view('doctor.doctor_details',$data);
        //echo "<pre>"; print_r($specialities); echo "</pre>";
    }

    public function doctorDetailAjax(Request $request){
        $doctor = Doctor::with('contacts')
            ->with('chambers')
            ->with('home_address')
            ->where('doctor_id',$request->doctor_id)
            ->first();

        $special_days = DoctorSpecialDay::where('doctor_id',$doctor->doctor_id)
            ->join('doctor_special_day_types','doctor_special_day_types.doctor_special_day_type_id','=','doctor_special_days.special_day_id')
            ->get();

        $doctor_edit_detail = DB::table('doctor_edit_requests')
            ->where('doctor_id',$request->doctor_id)
            ->first();

        $specialities = DoctorSpeciality::where('doctor_id',$doctor->doctor_id)->get();
        $doctor->special_days = $special_days;
        $doctor->doctor_specialities = $specialities;
        return ['status'=>200, 'doctor'=>$doctor, 'doctor_edit_detail'=>$doctor_edit_detail];
        //echo "<pre>"; print_r($specialities); echo "</pre>";
    }

    public function doctorUpdate(Request $request){
        $doctor = Input::all();
        $result = Input::all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'qualification' => 'required',

        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
        }else{

            //try{
                DB::beginTransaction();

                $name = Utility::sanitize_string($request->name);
                $email = $request->email;
                $gender = Utility::sanitize_string( $request->gender);
                $price = Utility::sanitize_decimal( $request->price);
                $contact = $request->contact;
                $class = Utility::sanitize_number( $request->class);
                $qualification = Utility::sanitize_string($request->qualification);

                $home_address1 = Utility::sanitize_string($request->home_address1);
                //$address2 = Utility::sanitize_string($request->address2);
                $home_division = Utility::sanitize_number($request->home_division);
                $home_district = Utility::sanitize_number($request->home_district);
                $home_thana = Utility::sanitize_number($request->home_thana);
                $home_zip = Utility::sanitize_number($request->home_zip);
                $honorium = Utility::sanitize_number($request->honorarium);

                //Doctor store
                $doctor = Doctor::where('doctor_id',$request->doctor_id)->first();
                $doctor->name = $name;
                $doctor->email = implode(",",$email);
                $doctor->created_by = 1;
                $doctor->qualification = $qualification;
                $doctor->class_id = $class;
                $doctor->gender = $gender;
                $doctor->other_special_day = '';
                $doctor->honorium = $honorium;
                $doctor->status = 'active';
                $doctor->is_edit_request = 0;
                $doctor->save();
                $doctor_id = $doctor->doctor_id;

                /*
                 * Adding doctor home addresses
                */
                DoctorHomeAddress::where('doctor_id',$doctor_id)->delete();
                $homeAddress = NEW DoctorHomeAddress();
                $homeAddress->doctor_id = $doctor_id;
                $homeAddress->address_line1	 = $home_address1;
                $homeAddress->address_line2	 = '';
                $homeAddress->division	 = $home_division;
                $homeAddress->district	 = $home_district;
                $homeAddress->thana	 = $home_thana;
                $homeAddress->zip	 = $home_zip;
                $homeAddress->save();

                /*
                 * Adding doctor contact numbers
                */
                $contact_nos = $request->contact;

                DoctorContact::where('doctor_id',$doctor_id)->delete();
                foreach($contact_nos as $key => $contact_no){
                    if($contact_no !='') {
                        $contact = NEW DoctorContact();
                        $contact->doctor_id = $doctor_id;
                        $contact->contact_no = $contact_no;
                        $contact->save();
                    }
                }

                /*
                 * Adding doctor specialities
                */
                $doctor_specialities = $request->speciality;
                DoctorSpeciality::where('doctor_id',$doctor_id)->delete();
                foreach($doctor_specialities as $key => $ds){
                    if($request->speciality[$key] !=''){
                        $speciality = NEW DoctorSpeciality();
                        $speciality->doctor_id = $doctor_id;
                        $speciality->speciality_id = $request->speciality[$key];
                        $speciality->save();
                    }
                }

                /*
                 * Adding doctor special days
                */
                $special_days = $request->special_day_type;
                $special_day_dates = $request->special_day_date;
                DoctorSpecialDay::where('doctor_id',$doctor_id)->delete();
                if(!empty($special_days)) {
                    foreach ($special_days as $key => $special_day) {
                        $specialDay = NEW DoctorSpecialDay();
                        $specialDay->doctor_id = $doctor_id;
                        $specialDay->special_day_id = $request->special_day_type[$key];
                        $specialDay->message = $request->remark[$key];
                        $specialDay->date = date('Y-m-d', strtotime($special_day_dates[$key]));
                        $specialDay->save();
                    }
                }

                /*
                 * Adding doctor chamber addresses
                */
                $chamber_address = $request->chember_address1;
                Doctor_chamber::where('doctor_id',$doctor_id)->delete();
                foreach($chamber_address as $key => $chamber_addr){
                    if($chamber_address[$key]!=''){
                        $chamber = NEW Doctor_chamber();
                        $chamber->doctor_id = $doctor_id;
                        $chamber->address_line1 = $chamber_address[$key];
                        $chamber->address_line2 = '';
                        $chamber->division = $request->chamber_division[$key];
                        $chamber->district	= $request->chamber_district[$key];
                        $chamber->thana	= $request->chamber_thana[$key];
                        $chamber->zip = $request->chamber_zip[$key];
                        $chamber->save();
                    }
                }

                /*Deleting edit request row*/
                DB::table('doctor_edit_requests')->where('doctor_id',$doctor_id)->delete();

                return ['status'=>200,'reason'=>'Doctor successfully saved','val'=>'Success'];

            /*}catch(\Exception $e){
                DB::rollback();
                return ['status'=>401, 'reson'=>$e->getMessage()];
            }*/
        }
    }

    public function declineDoctorChanges(Request $request){
        $doctor = Doctor::where('doctor_id',$request->doctor_id)->first();
        $doctor->status = 'active';
        $doctor->is_edit_request = 0;
        $doctor->save();

        /*Deleting edit request row*/
        DB:table('doctor_edit_requests')->where('doctor_id',$request->doctor_id)->delete();
    }


    /**
     * Product Delete By Ajax function.
    */
    public function doctorDelete(Request $request)
    {
    	try{
        DB::beginTransaction();
	    	$id = $request->id;
	    	$status = $request->status;

	    	$obj = Doctor::find($id);
	    	if($status == 1){
		    	$obj->status = 'active';
                $message = 'Doctor successfully activated';
	    	}
            if($status == 2){
                $obj->status = 'inactive';
                $message = 'Doctor successfully deactivated';
            }
            if($status == 4){
                $obj->status = 'rejected';
                $message = 'Doctor successfully rejected';
            }
	    	if($obj->save()){
	    		return ['status'=>200,'reason'=>$message,'val'=>'Success'];
	    	}
	    }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reson'=>$e->getMessage()];
    	}
    }

    /**
     * Doctor By Ajax function.
    */
    public function doctorDcr(Request $request)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Report';

        return view('doctor.doctorDcr',$data);
    }

    /**
     * Doctor get By Ajax function.
    */
    public function getDoctorDcr(Request $request)
    {

        $data['dcr'] = DB::table('doctor_dcr')
                ->select('doctor_dcr.*','users.first_name','users.last_name','doctors.name','users.user_id','territories.name as trrName')
                ->leftJoin('users','doctor_dcr.user_id','=','users.id')
                ->leftJoin('doctors','doctor_dcr.doctor_id','=','doctors.doctor_id')
                ->leftJoin('territories','users.location_id','=','territories.territory_id')
                ->orderBy('doctor_dcr.doctor_dcr_id','DESC')
                ->get();
        foreach ( $data['dcr'] as $key => $value) {
            $product = DB::table('doctor_dcr_products')
                ->select('products.name')
                ->join('products','doctor_dcr_products.product_id','=','products.product_id')
               ->where('doctor_dcr_products.doctor_dcr_id',$value->doctor_dcr_id)
               ->get();
            $data['dcr'][$key]->product = $product;
        }        

        return ['status'=>200,'val'=>$data,'reson'=>'Success'];

    }

    /**
     * Doctor dcr Accepted By Ajax function.
    */
    public function deleteDoctorDcr(Request $request)
    {
        try{
        DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;
            $result = DB::table('doctor_dcr')->where('doctor_dcr_id',$id)->update([
                'status'=>'accepted'
            ]);
            if($result){
                return ['status'=>200,'reason'=>'Operation success','val'=>'Success'];
            }
        }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reson'=>$e->getMessage()];
        }
    }

    /**
     * Doctor Dcr rejected by Ajax function.
    */
    public function rejectDoctorDcr(Request $request)
    {
        try{
        DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;
            $reson = $request->reson;
            $result = DB::table('doctor_dcr')->where('doctor_dcr_id',$id)->update([
                'status'=>'rejected',
                'reject_reason'=>$reson
            ]);
            if($result){
                return ['status'=>200,'reason'=>'Operation success','val'=>'Success'];
            }
        }catch(\Exception $e){ 
            DB::rollback();
        return ['status'=>401, 'reson'=>$e->getMessage()];
        }
    }





    /**
     * doctor Special date Type setup.==============================
    */

    #doctor special date type view
    public function doctorSpDayType(Request $request){

        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),59)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        return view('doctor.special_day_type',$data);
    }

    #doctor special date type view
    public function getdoctorSpecialDayType(Request $request){
        $result = DoctorSpDayType::orderBy('doctor_special_day_type_id','DESC')->get();
        return ['status'=>200,'reason'=>'Success','val'=>$result];
    } 

    #doctor special date type view
    public function doctorSpecialDayStore(Request $request){
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if (!$validator->passes()) {    
            return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
        }else{

                try{
                DB::beginTransaction();
                    
                    $name = Utility::sanitize_string($request->name);

                    $obj = new DoctorSpDayType;
                    $obj->name = $name;
                    $result = $obj->save();
                    if($result){
                        return ['status'=>200,'reason'=>'doctor special day added successfully','val'=>'Success'];
                    }
                }catch(\Exception $e){ 
                    DB::rollback();
                return ['status'=>200, 'reson'=>$e->getMessage()];
                }

            }
    } 

    #doctor special date type view
    public function getdoctorSpDayEditVal(Request $request){
        $id = $request->id;
        $result = DoctorSpDayType::where('doctor_special_day_type_id',$id)->first();
        return ['status'=>200,'reason'=>'success','val'=>$result];
    }    

    #doctor special date type view
    public function doctorSpecialDayTypeUpdate(Request $request)
    { 
        $validator = Validator::make($request->all(), [ 'name' => 'required' ]);

    if (!$validator->passes()) {    
        return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

            try{
            DB::beginTransaction();
                
                $name = Utility::sanitize_string($request->name);
                $id = $request->id;

                $obj = DoctorSpDayType::find($id);
                $obj->name = $name;
                $result = $obj->save();
                if($result){
                    return ['status'=>200,'reason'=>'doctor Special day type updated successfully','val'=>'Success'];
                }
            }catch(\Exception $e){ 
                DB::rollback();
            return ['status'=>200, 'reson'=>$e->getMessage()];
            }

        }  
    } 

    #doctor special date type Active/Inactive
    public function deldoctorSpecialDayType(Request $request)
    {
        try{
        DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;
            if($status == 2){ $reson = 'doctor special day type inactive successfully'; }
            if($status == 1){ $reson = 'doctor special day type active successfully'; }
            $obj = DoctorSpDayType::find($id);
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
        return ['status'=>401, 'reson'=>$e->getMessage()];
        }
    }

    public function getDoctorEvents(Request $request){
        $this_month = date('m');
        $this_day = date('d');

        $doctorEvents = DoctorSpecialDay::select('doctor_special_days.*','doctors.*','doctor_special_day_types.name as special_day_name','classes.class_name')
            ->join('doctor_special_day_types','doctor_special_day_types.doctor_special_day_type_id','=','doctor_special_days.special_day_id')
            ->join('doctors','doctors.doctor_id','=','doctor_special_days.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->whereMonth('date', '=', $this_month)
            ->whereDay('date', '=', $this_day)
            ->get();
        $list = '';
        $count=1;
        foreach($doctorEvents as $event){
            $contacts = DoctorContact::select('contact_no')->where('doctor_id',$event->doctor_id)->pluck('contact_no')->toArray();
            $specialities = DoctorSpeciality::select('specialities.name')->where('doctor_id',$event->doctor_id)
                ->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
                ->pluck('specialities.name')->toArray();

            $list.='<tr>';
            $list.='<td>'.$count.'</td>';
            $list.='<td>'.$event->name.'</td>';
            $list.='<td>'.$event->gender.'</td>';
            $list.='<td>'.$event->qualification.'</td>';
            $list.='<td>'.str_replace(',','<br>',implode(',',$specialities)).'</td>';
            $list.='<td>'.$event->class_name.'</td>';
            if($event->honorium==1){
                $list.='<td>Yes</td>';
            }
            else{
                $list.='<td>No</td>';
            }
            $list.='<td>'.str_replace(',','<br>',implode(',',$contacts)).'</td>';
            $list.='<td>'.$event->email.'</td>';
            $list.='<td>'.$event->special_day_name.'</td>';
            //$list.='<td>'.date('d/m/Y',strtotime($event->date)).'</td>';
            $list.='<td>'.date('d.m.Y').'</td>';
            $list.='</tr>';

            $count++;
        }

        return ['status'=>200, 'reason'=>'', 'events'=>$list];
    }

}
