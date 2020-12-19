<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\DoctorEditRequest;
use App\Models\DoctorHomeAddress;
use App\Models\DoctorContact;
use App\Models\Doctor_chamber;
use App\Models\DoctorSpeciality;
use App\Models\DoctorSpecialDay;
use App\Models\DoctorSpecialDayTypes;
use App\Models\Specialities;
use App\Common;
use DB;

/*
 * 1. Create Doctor
 * url: http://202.125.76.60/v1/doctor/create
 * parameters: {token,oauth_token,data}
 * data = {"user_id":1,"name":"prince","contact_no":"[{\"contact_no\":\"123456\"},{\"contact_no\":\"123456\"}]","email":"prince@bbil.com","gender":"Male","address_line1":"Shyamoli, Dhaka","address_line2":"","division":1,"district":2,"thana":1,"zip":"z12345","qualification":"abc","specialities":[1,2,3],"class":1,"special_days":"[{\"special_day_id\":1,\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day_id\":2,\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","other_special_day":"[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","chamber_address":"[{\"address_line1\":\"addr1\",\"address_line2\":\"addr2\",\"division\":1,\"district\":2,\"thana\":1,\"zip\":\"1234\"},{\"address_line1\":\"addr1.2\",\"address_line2\":\"addr2.2\",\"division\":2,\"district\":1,\"thana\":5,\"zip\":\"4321\"}]"}
 *
 * 2. Filter Doctor
 * url: http://202.125.76.60/v1/doctor/filter
 * parameters: {token,oauth_token,contact_no,specialist,name,territory}
 *
 * 2.1. Search Doctor
 * url: http://202.125.76.60/v1/doctor/search
 * parameters: {token,oauth_token,name}
 *
 * 3. Update Doctor
 * url: http://202.125.76.60/v1/doctor/update
 * parameters: {token,data}
 * {"oauth_token":"0dfgdfdf4411","user_id":1,"doctor_id":1,name":"prince","contact_no":"[{\"contact_no\":\"123456\"},{\"contact_no\":\"123456\"}]","email":"prince@bbil.com","gender":"Male","address_line1":"Shyamoli, Dhaka","address_line2":"","division":1,"district":2,"thana":1,"zip":"z12345","qualification":"abc","specialities":[1,2,3],"class":1,"special_days":"[{\"special_day_id\":1,\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day_id\":2,\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","other_special_day":"[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","chamber_address":"[{\"address_line1\":\"addr1\",\"address_line2\":\"addr2\",\"division\":1,\"district\":2,\"thana\":1,\"zip\":\"1234\"},{\"address_line1\":\"addr1.2\",\"address_line2\":\"addr2.2\",\"division\":2,\"district\":1,\"thana\":5,\"zip\":\"4321\"}]"}
 *
 * 3.1. Add Doctor Chamber
 * url: http://202.125.76.60/v1/doctor/add_chamber
 * parameters: {token,oauth_token,data}
 * {"doctor_id":1,"address_line1":"addr, shm, dhk","address_line2":"","division":2,"district":1,"thana":2,"zip":"123458"}
 *
 * 4. Doctor Details
 * url: http://202.125.76.60/v1/doctor/details
 * parameters: {token,oauth_token,doctor_id}
 *
 * 5. Speciality list
 * url: http://202.125.76.60/v1/doctor/specialities
 * parameters: {token,oauth_token}
 *
 * 6. Doctor Special Day Type List
 * url: http://202.125.76.60/v1/doctor/special_day_types
 * parameters: {token,oauth_token}
 *
 * 7. Doctor List
 * url: http://202.125.76.60/v1/doctor/list
 * parameters: {token,oauth_token}
 *
 * 8. Doctor class
 * url: http://202.125.76.60/v1/doctor/classes
 * parameters: {token,oauth_token}
 *
 * 9. Get PPMs
 * url: http://202.125.76.60/v1/doctor/ppms
 * parameters: {token,oauth_token}
 * */

class DoctorController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        //$doctorData = gzuncompress($request->data);
        $doctorData = json_decode($request->data,true);

        /*####################### Validation area ###########################*/
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($doctorData['user_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }
        if($doctorData['name'] == ''){
            return json_encode(['status'=>401,'reason'=>'Name required']);
        }
        if($doctorData['gender'] == ''){
            return json_encode(['status'=>401,'reason'=>'Gender required']);
        }

        /*if($doctorData['contact_no'] == ''){
            return json_encode(['status'=>401,'reason'=>'Contact number required']);
        }*/

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        /*####################### Validation area ends ###########################*/

        $doctor = NEW Doctor();
        $doctor->name = $doctorData['name'];
        $doctor->email = $doctorData['email'];
        $doctor->gender = $doctorData['gender'];
        $doctor->created_by = $doctorData['user_id'];
        $doctor->qualification = $doctorData['qualification'];
        $doctor->class_id = $doctorData['class'];
        $doctor->status = 'pending';
        $doctor->other_special_day = json_encode($doctorData['other_special_day']);
        $doctor->save();

        /*
         * Adding doctor home addresses
         */
        $homeAddress = NEW DoctorHomeAddress();
        $homeAddress->doctor_id = $doctor->doctor_id;
        $homeAddress->address_line1	 = $doctorData['address_line1'];
        $homeAddress->address_line2	 = $doctorData['address_line2'];
        $homeAddress->division	 = $doctorData['division']	;
        $homeAddress->district	 = $doctorData['district']	;
        $homeAddress->thana	 = $doctorData['thana']	;
        $homeAddress->zip	 = $doctorData['zip']	;
        $homeAddress->save();

        /*
         * Adding doctor contact numbers
         */
        //$contact_nos = json_decode($doctorData['contact_no'],true);
        $contact_nos = $doctorData['contact_no'];
        foreach($contact_nos as $contact_no){
            $contact = NEW DoctorContact();
            $contact->doctor_id = $doctor->doctor_id;
            $contact->contact_no = $contact_no['contact_no'];
            $contact->save();
        }

        /*
         * Adding doctor chamber addresses
         */
        //$chamber_address = json_decode($doctorData['chamber_address'],true);
        $chamber_address = $doctorData['chamber_address'];
        foreach($chamber_address as $chamber_addr){
            $chamber = NEW Doctor_chamber();
            $chamber->doctor_id = $doctor->doctor_id;
            $chamber->address_line1 = $chamber_addr['address_line1'];
            $chamber->address_line2 = $chamber_addr['address_line2'];
            $chamber->division = $chamber_addr['division']	;
            $chamber->district	= $chamber_addr['district']	;
            $chamber->thana	= $chamber_addr['thana']	;
            $chamber->zip = $chamber_addr['zip']	;
            $chamber->save();
        }

        /*
         * Adding doctor specialities
         */
        //$doctor_specialities = json_decode($doctorData['specialities'],true);
        $doctor_specialities = $doctorData['specialities'];
        foreach($doctor_specialities as $ds){
            $speciality = NEW DoctorSpeciality();
            $speciality->doctor_id = $doctor->doctor_id;
            $speciality->speciality_id = $ds;
            $speciality->save();
        }

        /*
         * Adding doctor special days
         */
        //$special_days = json_decode($doctorData['special_days'],true);
        $special_days = $doctorData['special_days'];
        foreach($special_days as $special_day){
            $specialDay = NEW DoctorSpecialDay();
            $specialDay->doctor_id = $doctor->doctor_id;
            $specialDay->special_day_id = $special_day['special_day_id'];
            $specialDay->message = $special_day['message'];
            $specialDay->date = date('Y-m-d', strtotime($special_day['date']));
            $specialDay->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successfully created','doctor_id'=>$doctor->doctor_id,'email'=>$doctor->email]);

    }

    public function filter(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($request->name == ''){
            return json_encode(['status'=>401,'reason'=>'Name required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        /*
         * Search doctor based on territory
        */
        $doctors = array();
        $doctor_speciality = array();
        $doctor_name = array();
        if($request->contact_no==''){
            $chambers = Doctor_chamber::select('doctors.*','doctor_contacts.contact_no','specialities.name as speciality')
                ->where('doctors.status','active')
                ->join('doctors','doctors.doctor_id','doctor_chambers.doctor_id')
                ->leftJoin('doctor_contacts','doctor_contacts.doctor_id','doctor_chambers.doctor_id')
                ->leftJoin('doctor_specialities','doctor_specialities.doctor_id','doctor_chambers.doctor_id')
                ->leftJoin('specialities','specialities.speciality_id','doctor_specialities.speciality_id')
                ->where('doctors.name', 'like', '%'.$request->name.'%')
                ->groupBy('doctors.doctor_id')
                ->get();
        }
        else{
            $chambers = Doctor_chamber::select('doctors.*','doctor_contacts.contact_no','specialities.name as speciality')
                ->where('doctor_contacts.contact_no',$request->contact_no)
                ->where('doctors.status','active')
                ->join('doctors','doctors.doctor_id','doctor_chambers.doctor_id')
                ->leftJoin('doctor_contacts','doctor_contacts.doctor_id','doctor_chambers.doctor_id')
                ->leftJoin('doctor_specialities','doctor_specialities.doctor_id','doctor_chambers.doctor_id')
                ->leftJoin('specialities','specialities.speciality_id','doctor_specialities.speciality_id')
                ->groupBy('doctors.doctor_id')
                ->get();
        }

        if(empty($chambers)){
            return json_encode(['status'=>200,'data'=>$doctors]);
        }
        else{
            foreach($chambers as $chamber){
				$doctor_contacts = DoctorContact::select('doctor_contacts.contact_no')
				->where('doctor_contacts.doctor_id',$chamber->doctor_id)
                ->pluck('doctor_contacts.contact_no')->toArray();
				$home_address = DoctorHomeAddress::where('doctor_id',$chamber->doctor_id)->get();
				$special_days = DoctorSpecialDay::where('doctor_id',$chamber->doctor_id)->get();
				
                $doctor['doctor_id'] = $chamber->doctor_id;
                $doctor['name'] = $chamber->name;
                $doctor['qualification'] = $chamber->qualification;
                $doctor['speciality'] = $chamber->speciality;
                $doctor['contact_number'] = implode(',',$doctor_contacts);
                $doctor['home_address'] = $home_address;
                $doctor['special_days'] = $special_days;
                array_push($doctors,$doctor);
            }
        }


        if($request->speciality !=''){
            foreach($doctors as $doc){
                if($doc->speciality==$request->speciality){
                    $doctor['doctor_id'] = $doc['doctor_id'];
                    $doctor['name'] = $doc['name'];
                    $doctor['qualification'] = $doc['qualification'];
                    $doctor['speciality'] = $doc['speciality'];
					$doctor['contact_number'] = $doc['contact_number'];
					$doctor['home_address'] = $doc['home_address'];
					$doctor['special_days'] = $doc['special_days'];
                    array_push($doctor_speciality,$doctor);
                }
            }
            if(count($doctor_speciality)!=0){
                $doctors = $doctor_speciality;
            }
        }
        if($request->name !=''){
            foreach($doctors as $doc){
                if(strpos($doc['name'], $request->name) === 0){
                    $doctor['doctor_id'] = $doc['doctor_id'];
                    $doctor['name'] = $doc['name'];
                    $doctor['qualification'] = $doc['qualification'];
                    $doctor['speciality'] = $doc['speciality'];
					$doctor['contact_number'] = $doc['contact_number'];
					$doctor['home_address'] = $doc['home_address'];
					$doctor['special_days'] = $doc['special_days'];
                    array_push($doctor_name,$doctor);
                }
            }
            if(count($doctor_name)!=0){
                $doctors = $doctor_name;
            }
        }
        return json_encode(['status'=>200,'data'=>$doctors]);
    }

    public function search(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        if($request->name == ''){
            return json_encode(['status'=>401,'reason'=>'Name required']);
        }

        /*
         * Search doctor based on name
        */
        if($user->role_id==5){ // If from MPO
            //$parent_id = $user->parent_id;
            $am = User::select('users.*','zsm.id as zsm_id')->where('users.id',$user->parent_id)
                ->join('users as rsm','rsm.id','=','users.parent_id')
                ->join('users as zsm','zsm.id','=','rsm.parent_id')
                ->first();
            $zsm_id = $am->zsm_id;

            // Get all rsm ids associate with the zsm
            $all_rsm = User::select('id')->where('parent_id',$zsm_id)->orderBy('id','asc')->pluck('id')->toArray();

            // Get all am ids associate with the all_rsm
            $all_am = User::select('id')->whereIn('parent_id',$all_rsm)->orderBy('id','asc')->pluck('id')->toArray();

            $thanas = User::select('territories.thana_id')->whereIn('parent_id',$all_am)
                ->join('territories','territories.territory_id','=','users.location_id')
                ->groupBy('location_id')
                ->pluck('territories.thana_id')->toArray();
            //return $thanas;
        }
        else{
            /*$thanas = User::select('territories.thana_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->groupBy('location_id')
                ->pluck('territories.thana_id')->toArray();*/

            $am = User::select('users.*','zsm.id as zsm_id')->where('users.id',$user->id)
                ->join('users as rsm','rsm.id','=','users.parent_id')
                ->join('users as zsm','zsm.id','=','rsm.parent_id')
                ->first();
            $zsm_id = $am->zsm_id;

            // Get all rsm ids associate with the zsm
            $all_rsm = User::select('id')->where('parent_id',$zsm_id)->orderBy('id','asc')->pluck('id')->toArray();

            // Get all am ids associate with the all_rsm
            $all_am = User::select('id')->whereIn('parent_id',$all_rsm)->orderBy('id','asc')->pluck('id')->toArray();

            $thanas = User::select('territories.thana_id')->whereIn('parent_id',$all_am)
                ->join('territories','territories.territory_id','=','users.location_id')
                ->groupBy('location_id')
                ->pluck('territories.thana_id')->toArray();
        }

        $doctors = Doctor::select('doctors.*','specialities.name as speciality','classes.class_name')
            ->where('doctors.name','like','%'.$request->name.'%')
            ->join('doctor_chambers','doctor_chambers.doctor_id','doctors.doctor_id')
            ->leftJoin('classes','doctors.class_id','classes.class_id')
            ->leftJoin('doctor_specialities','doctor_specialities.doctor_id','doctors.doctor_id')
            ->leftJoin('specialities','specialities.speciality_id','doctor_specialities.speciality_id')
            ->whereIn('doctor_chambers.thana',$thanas)
            ->where('doctors.status','active')
            ->groupBy('doctor_chambers.doctor_id')
            ->get();

		$doctor_array = array();
        foreach($doctors as $key=>$doctor){
            $contacts = DoctorContact::select('contact_no')->where('doctor_id',$doctor->doctor_id)->pluck('contact_no')->toArray();
            //$specialities = DoctorSpeciality::where('doctor_id',$doctor->doctor_id)->get();
            $chambers = Doctor_chamber::where('doctor_id',$doctor->doctor_id)->get();
            $home_address = DoctorHomeAddress::where('doctor_id',$doctor->doctor_id)->get();
            $special_days = DoctorSpecialDay::where('doctor_id',$doctor->doctor_id)->get();
            /*$doctors[$key]->contacts = $contacts;
            $doctors[$key]->specialities = $specialities;
            $doctors[$key]->chambers = $chambers;
            $doctors[$key]->home_address = $home_address;
            $doctors[$key]->special_days = $special_days;*/
			
			$doctor['doctor_id'] = $doctor->doctor_id;
			$doctor['name'] = $doctor->name;
			$doctor['qualification'] = $doctor->qualification;
			$doctor['speciality'] = $doctor->speciality;
            $doctor['contact_number'] = implode(',',$contacts);
			$doctor['chambers'] = $chambers;
			$doctor['home_address'] = $home_address;
			$doctor['special_days'] = $special_days;
			array_push($doctor_array,$doctor);
        }
        return json_encode(['status'=>200,'data'=>$doctor_array]);
    }

    public function update(Request $request){
        //$doctorData = gzuncompress($request->data);
        $doctorData = json_decode($request->data,true);

        /*####################### Validation area ###########################*/
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($doctorData['user_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }

        if($doctorData['doctor_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Doctor id required']);
        }


        if($doctorData['name'] == ''){
            return json_encode(['status'=>401,'reason'=>'Name required']);
        }

        if($doctorData['contact_no'] == ''){
            return json_encode(['status'=>401,'reason'=>'Contact number required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        /*####################### Validation area ends ###########################*/



        /*Save edit request*/
        $doctorEdit = NEW DoctorEditRequest();
        $doctorEdit->name = $doctorData['name'];
        $doctorEdit->email = $doctorData['email'];
        $doctorEdit->qualification = $doctorData['qualification'];
        $doctorEdit->class_id = $doctorData['class'];
        $doctorEdit->status = 'pending';
        $doctorEdit->other_special_day = $doctorData['other_special_day'];
        $doctorEdit->contacts = $doctorData['contact_no'];
        $doctorEdit->specialities = json_encode($doctorData['specialities']);
        $doctorEdit->special_days = $doctorData['special_days'];
        $doctorEdit->chamber_address = $doctorData['chamber_address'];
        $doctorEdit->home_address1 = $doctorData['address_line1'];
        $doctorEdit->home_division = $doctorData['division'];
        $doctorEdit->home_district = $doctorData['district'];
        $doctorEdit->home_thana = $doctorData['thana'];
        $doctorEdit->home_zip = $doctorData['zip'];
        $doctorEdit->save();

        /*Save edit request ends*/


        /*$doctor = Doctor::where('doctor_id',$doctorData['doctor_id'])->first();
        $doctor->name = $doctorData['name'];
        $doctor->email = $doctorData['email'];
        $doctor->qualification = $doctorData['qualification'];
        $doctor->class_id = $doctorData['class'];
        $doctor->other_special_day = $doctorData['other_special_day'];
        $doctor->save();

        // Adding doctor home addresses
        // First delete home address for this doctor
        DoctorHomeAddress::where('doctor_id',$doctorData['doctor_id'])->delete();
        // Now add new home address
        $homeAddress = NEW DoctorHomeAddress();
        $homeAddress->doctor_id = $doctor->doctor_id;
        $homeAddress->address_line1	 = $doctorData['address_line1'];
        $homeAddress->address_line2	 = $doctorData['address_line2'];
        $homeAddress->division	 = $doctorData['division'];
        $homeAddress->district	 = $doctorData['district'];
        $homeAddress->thana	 = $doctorData['thana'];
        $homeAddress->zip	 = $doctorData['zip'];
        $homeAddress->save();


        // Adding doctor contact numbers
        $contact_nos = json_decode($doctorData['contact_no'],true);
        // First delete contacts for this doctor
        DoctorContact::where('doctor_id',$doctorData['doctor_id'])->delete();
        // Now add new contact numbers
        foreach($contact_nos as $contact_no){
            $contact = NEW DoctorContact();
            $contact->doctor_id = $doctorData['doctor_id'];
            $contact->contact_no = $contact_no['contact_no'];
            $contact->save();
        }


        $chamber_address = json_decode($doctorData['chamber_address'],true);
        // First delete chamber address for this doctor
        Doctor_chamber::where('doctor_id',$doctorData['doctor_id'])->delete();
        // Now add new chamber address
        foreach($chamber_address as $chamber_addr){
            $chamber = NEW Doctor_chamber();
            $chamber->doctor_id = $doctor->doctor_id;
            $chamber->address_line1 = $chamber_addr['address_line1'];
            $chamber->address_line2 = $chamber_addr['address_line2'];
            $chamber->division = $chamber_addr['division'];
            $chamber->district	= $chamber_addr['district'];
            $chamber->thana	= $chamber_addr['thana'];
            $chamber->zip = $chamber_addr['zip'];
            $chamber->save();
        }

        // Adding doctor specialities
        //$doctor_specialities = json_decode($doctorData['specialities'],true);
        $doctor_specialities = $doctorData['specialities'];
        // First delete specialities for this doctor
        DoctorSpeciality::where('doctor_id',$doctorData['doctor_id'])->delete();
        // Now add new specialities
        foreach($doctor_specialities as $ds){
            $speciality = NEW DoctorSpeciality();
            $speciality->doctor_id = $doctorData['doctor_id'];
            $speciality->speciality_id = $ds;
            $speciality->save();
        }

        // Adding doctor special days
        $special_days = json_decode($doctorData['special_days'],true);
        // First delete special days for this doctor
        DoctorSpecialDay::where('doctor_id',$doctorData['doctor_id'])->delete();
        // Now add new special days
        foreach($special_days as $special_day){
            $specialDay = NEW DoctorSpecialDay();
            $specialDay->doctor_id = $doctorData['doctor_id'];
            $specialDay->special_day_id = $special_day['special_day_id'];
            $specialDay->message = $special_day['message'];
            $specialDay->date = date('Y-m-d', strtotime($special_day['date']));
            $specialDay->save();
        }*/

        return json_encode(['status'=>200,'reason'=>'Successfully saved']);


    }

    public function addChamber(Request $request){
        $doctorData = json_decode($request->data,true);

        /*####################### Validation area ###########################*/
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($doctorData['doctor_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Doctor id required']);
        }


        if($doctorData['address_line1'] == ''){
            return json_encode(['status'=>401,'reason'=>'Address Line1 required']);
        }

        if($doctorData['division'] == ''){
            return json_encode(['status'=>401,'reason'=>'Division required']);
        }

        if($doctorData['district'] == ''){
            return json_encode(['status'=>401,'reason'=>'District required']);
        }

        if($doctorData['thana'] == ''){
            return json_encode(['status'=>401,'reason'=>'Thana required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        // Now add new chamber address
        $chamber = NEW Doctor_chamber();
        $chamber->doctor_id = $doctorData['doctor_id'];
        $chamber->address_line1 = $doctorData['address_line1'];
        $chamber->address_line2 = $doctorData['address_line2'];
        $chamber->division = $doctorData['division'];
        $chamber->district	= $doctorData['district'];
        $chamber->thana	= $doctorData['thana'];
        $chamber->zip = $doctorData['zip'];
        $chamber->save();

        return json_encode(['status'=>200,'reason'=>'Successfully saved']);

    }

    public function details(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $doctor = Doctor::where('doctor_id',$request->doctor_id)->first();
        return json_encode(['status'=>200,'data'=>json_encode($doctor)]);
    }

    public function specialities(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $specialities = Specialities::where('status','active')->get();
        return json_encode(['status'=>200,'data'=>$specialities]);
    }

    public function specialDayTypes(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $special_day_types = DoctorSpecialDayTypes::where('status','active')->get();
        return json_encode(['status'=>200,'data'=>$special_day_types]);
    }

    public function doctorList(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $doctors = Doctor::select('doctors.doctor_id','doctors.name','doctors.email')
            ->where('status','active')
            ->where('created_by',$request->user_id)->get();
        return json_encode(['status'=>200,'data'=>$doctors]);
    }

    public function classes(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        $classes = DB::table('classes')->select('class_id','class_name')->where('type',1)->where('status','active')->get();
        return json_encode(['status'=>200,'data'=>$classes]);
    }

    public function ppms(Request $request){
        if($request->token !=Common::TOKEN_DOCTOR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        $ppms = DB::table('ppms')->select('ppm_id','name')->where('status','Active')->get();
        return json_encode(['status'=>200,'data'=>$ppms]);
    }
}
