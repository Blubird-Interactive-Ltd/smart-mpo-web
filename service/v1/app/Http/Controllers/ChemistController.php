<?php

namespace App\Http\Controllers;

use App\Models\ChemistSpecialDay;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chemist;
use App\Models\ChemistAddress;
use App\Models\ChemistContact;
use App\Models\ChemistTerritory;
use App\Models\ChemistSpecialDayTypes;
use App\Models\ChemistCategory;
use App\Common;
use DB;

/*
 * 1. Create Chemist
 * url: http://202.125.76.60/chemist/create
 * parameters: {token,oauth_token,data}
 * data = {"user_id":1,"name":"prince","contact_no":"[{\"contact_no\":\"123456\"},{\"contact_no\":\"123456\"}]","email":"prince@bbil.com","address_line1":"Shyamoli, Dhaka","address_line2":"","division":1,"district":2,"thana":1,"zip":"z12345","territories":[1,2,3],"category_id":1,"class_id":2,"special_days":"[{\"special_day_id\":1,\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day_id\":2,\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","other_special_day":"[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","chamber_address":"[{\"address_line1\":\"addr1\",\"address_line2\":\"addr2\",\"division\":1,\"district\":2,\"thana\":1,\"zip\":\"1234\"},{\"address_line1\":\"addr1.2\",\"address_line2\":\"addr2.2\",\"division\":2,\"district\":1,\"thana\":5,\"zip\":\"4321\"}]"}

 *
 * 2. Filter Chemist
 * url: http://202.125.76.60/service/v1/chemist/filter
 * parameters: {token,oauth_token,contact_no,territory,name}
 *
 * 3. Search Chemist
 * url: http://202.125.76.60/chemist/search
 * parameters: {token,oauth_token,name}
 *
 * 4. Update Chemist
 * url: http://202.125.76.60/chemist/update
 * parameters: {token,gzcompress(data)}
 * data = {"oauth_token":"0dfgdfdf4411","user_id":1,"chemist_id":9,"name":"prince","contact_no":"[{\"contact_no\":\"123456\"},{\"contact_no\":\"123456\"}]","email":"prince@bbil.com","address_line1":"Shyamoli, Dhaka","address_line2":"","division":1,"district":2,"thana":1,"zip":"z12345","territories":[1,2,3],"category_id":1,"class_id":2,"special_days":"[{\"special_day_id\":1,\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day_id\":2,\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","other_special_day":"[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]","chamber_address":"[{\"address_line1\":\"addr1\",\"address_line2\":\"addr2\",\"division\":1,\"district\":2,\"thana\":1,\"zip\":\"1234\"},{\"address_line1\":\"addr1.2\",\"address_line2\":\"addr2.2\",\"division\":2,\"district\":1,\"thana\":5,\"zip\":\"4321\"}]"}
 *
 * 5. Chemist Details
 * url: http://202.125.76.60/chemist/details
 * parameters: {token,oauth_token,chemist_id}
 *
 * 6. Chemist Special Day Types
 * url: http://202.125.76.60/chemist/special_day_types
 * parameters: {token,oauth_token}
 *
 * 7. Chemist Categories
 * url: http://202.125.76.60/chemist/categories
 * parameters: {token,oauth_token}
 *
 * 8. Doctor class
 * url: http://202.125.76.60/v1/doctor/classes
 * parameters: {token,oauth_token}
 * */

class ChemistController extends Controller
{
    public function index(){

    }


    public function create(Request $request){
        //$chemistData = gzuncompress($request->data);
        $chemistData = json_decode($request->data,true);

        /*####################### Validation area ###########################*/
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($chemistData['contact_no'] == ''){
            return json_encode(['status'=>401,'reason'=>'Contact number required']);
        }

        if($chemistData['user_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }

        if($chemistData['name'] == ''){
            return json_encode(['status'=>401,'reason'=>'Name required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        /*####################### Validation area ends ###########################*/

        $chemist = NEW Chemist();
        $chemist->name = $chemistData['name'];
        $chemist->category_id = $chemistData['category_id'];
        $chemist->class_id = $chemistData['class_id'];
        $chemist->status = 'pending';
        $chemist->created_by = $chemistData['user_id'];
        $chemist->other_special_day = json_encode($chemistData['other_special_day']);
        $chemist->save();

        /*
         * Adding chemist contact numbers
         */
        //$contact_nos = json_decode($chemistData['contact_no'],true);
        $contact_nos = $chemistData['contact_no'];
        foreach($contact_nos as $contact_no){
            $contact = NEW ChemistContact();
            $contact->chemist_id = $chemist->chemist_id;
            $contact->contact_no = $contact_no['contact_no'];
            $contact->save();
        }

        /*
         * Save chemist address
         */
        $address = NEW ChemistAddress();
        $address->chemist_id = $chemist->chemist_id;
        $address->address_line1	 = $chemistData['address_line1'];
        $address->address_line2	 = $chemistData['address_line2'];
        $address->division	 = $chemistData['division']	;
        $address->district	 = $chemistData['district']	;
        $address->thana	 = $chemistData['thana']	;
        $address->zip	 = $chemistData['zip']	;
        $address->save();

        /*
         * Adding chemist territories
         */
        //$territories = json_decode($chemistData['territories'],true);
        $territories = $chemistData['territories'];
        foreach($territories as $ter){
            $territory = NEW ChemistTerritory();
            $territory->chemist_id = $chemist->chemist_id;
            $territory->territory_id = $ter;
            $territory->save();
        }

        /*
         * Adding chemist special days
         */
        //$special_days = json_decode($chemistData['special_days'],true);
        $special_days = $chemistData['special_days'];
        foreach($special_days as $special_day){
            $specialDay = NEW ChemistSpecialDay();
            $specialDay->chemist_id = $chemist->chemist_id;
            $specialDay->special_day_id = $special_day['special_day_id'];
            $specialDay->message = $special_day['message'];
            $specialDay->date = date('Y-m-d', strtotime($special_day['date']));
            $specialDay->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successfully created','chemist_id'=>$chemist->chemist_id]);

    }

    public function filter(Request $request){
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->name == ''){
            return json_encode(['status'=>401,'reason'=>'Name required']);
        }
        if($request->territory == ''){
            return json_encode(['status'=>401,'reason'=>'Territory required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            //return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/


        /*
         * Search chemist based on territory
        */
        $chemists = array();
        $chemist_name = array();
        $territories = ChemistTerritory::select('chemists.*','chemist_contacts.contact_no')->where('territory_id',$request->territory)
            ->where('chemist_contacts.contact_no',$request->contact_no)
            ->where('status','active')
            ->join('chemists','chemists.chemist_id','chemist_territories.chemist_id')
            ->leftJoin('chemist_contacts','chemist_contacts.chemist_id','chemist_territories.chemist_id')
            ->get();

        if(empty($territories)){
            return json_encode(['status'=>200,'data'=>$chemists]);
        }
        else{
            foreach($territories as $territory){
                $chemist_address = ChemistAddress::where('chemist_address.chemist_id',$territory->chemist_id)
                    ->join('address_divisions','address_divisions.division_id','chemist_address.division')
                    ->join('address_districts','address_districts.district_id','chemist_address.district')
                    ->join('address_thanas','address_thanas.thana_id','chemist_address.thana')
                    ->first();					
                $chemist_contacts = ChemistContact::select('contact_no')->where('chemist_id',$territory->chemist_id)
                    ->pluck('contact_no')->toArray();
					
                $chemist['chemist_id'] = $territory->chemist_id;
                $chemist['name'] = $territory->name;
                $chemist['contact_number'] = implode(',',$chemist_contacts);
                if(!empty($chemist_address)){
                    $chemist['address'] = $chemist_address->address_line1.",".$chemist_address->division_name.",".$chemist_address->district_name.','.$chemist_address->thana_name.','.$chemist_address->zip;
                    //$chemist['address'] = $chemist_address;
                }
                else{
                    $chemist['address'] = '';
                }
                array_push($chemists,$chemist);
            }
        }

        if($request->name !=''){
            foreach($chemists as $chem){
                if(strpos($chem['name'], $request->name) === 0){
                    $chemist['chemist_id'] = $chem['chemist_id'];
                    $chemist['name'] = $chem['name'];
                    $chemist['contact_number'] = $chem['contact_number'];
                    $chemist['address'] = $chem['address'];
                    array_push($chemist_name,$chemist);
                }
            }
            if(count($chemist_name)!=0){
                $chemists = $chemist_name;
            }
        }


        return json_encode(['status'=>200,'data'=>$chemists]);
    }

    public function search(Request $request){
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        //$user = User::where('active_oauth_token',$request->oauth_token)->first();
        $user = User::where('id',104)->first();
        if(empty($user)){
            //return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        /*
         * Search chemist based on name
        */
        if($user->role_id==5){
            $am = User::select('users.*','zsm.id as zsm_id')->where('users.id',$user->parent_id)
                ->join('users as rsm','rsm.id','=','users.parent_id')
                ->join('users as zsm','zsm.id','=','rsm.parent_id')
                ->first();
            $zsm_id = $am->zsm_id;

            // Get all rsm ids associate with the zsm
            $all_rsm = User::select('id')->where('parent_id',$zsm_id)->orderBy('id','asc')->pluck('id')->toArray();

            // Get all am ids associate with the all_rsm
            $all_am = User::select('id')->whereIn('parent_id',$all_rsm)->orderBy('id','asc')->pluck('id')->toArray();

            $territories = User::select('location_id')->whereIn('parent_id',$all_am)
                ->orderBy('location_id','asc')
                ->groupBy('location_id')
                ->pluck('location_id')->toArray();
        }
        else{
            $territories = User::select('location_id')
                ->orderBy('location_id','asc')
                ->groupBy('location_id')
                ->pluck('location_id')->toArray();
        }

        //return json_encode(['status'=>200,'data'=>$territories]);

        $chemists = Chemist::select('chemists.*')->where('status','active')
            ->join('chemist_territories','chemist_territories.chemist_id','=','chemists.chemist_id')
            ->groupBy('chemists.chemist_id')
            ->where('name','like','%'.$request->name.'%')
            ->whereIn('chemist_territories.territory_id',$territories)
            ->get();
			
		$chemist_array = array();
		if(count($chemists) !=0){
			foreach($chemists as $key=>$value){								
                $chemist_address = ChemistAddress::where('chemist_address.chemist_id',$value->chemist_id)
                    ->join('address_divisions','address_divisions.division_id','chemist_address.division')
                    ->join('address_districts','address_districts.district_id','chemist_address.district')
                    ->join('address_thanas','address_thanas.thana_id','chemist_address.thana')
                    ->first();					
                $chemist_contacts = ChemistContact::select('contact_no')->where('chemist_id',$value->chemist_id)
                    ->pluck('contact_no')->toArray();
					
                $chemist['chemist_id'] = $value->chemist_id;
                $chemist['name'] = $value->name;
                $chemist['contact_number'] = implode(',',$chemist_contacts);
                if(!empty($chemist_address)){
                    $chemist['address'] = $chemist_address->address_line1.",".$chemist_address->division_name.",".$chemist_address->district_name.','.$chemist_address->thana_name.','.$chemist_address->zip;
                    //$chemist['address'] = $chemist_address;
                }
                else{
                    $chemist['address'] = '';
                }
                array_push($chemist_array,$chemist);
			}
		}
		

        return json_encode(['status'=>200,'data'=>$chemist_array]);
    }

    public function update(Request $request){
        //$chemistData = gzuncompress($request->data);
        $chemistData = json_decode($request->data,true);

        /*####################### Validation area ###########################*/
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($chemistData['user_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }

        if($chemistData['chemist_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Chemist id required']);
        }

        if($chemistData['contact_no'] == ''){
            return json_encode(['status'=>401,'reason'=>'Contact number required']);
        }

        if($chemistData['name'] == ''){
            return json_encode(['status'=>401,'reason'=>'Name required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        /*####################### Validation area ends ###########################*/

        $chemist = Chemist::where('chemist_id',$chemistData['chemist_id'])->first();
        $chemist->name = $chemistData['name'];
        $chemist->category_id = $chemistData['category_id'];
        $chemist->class_id = $chemistData['class_id'];
        $chemist->updated_by = $chemistData['user_id'];
        $chemist->other_special_day = $chemistData['other_special_day'];
        $chemist->save();

        /*
         * Adding chemist contact numbers
         */
        $contact_nos = json_decode($chemistData['contact_no'],true);
        // First delete contacts for this chemist
        ChemistContact::where('chemist_id',$chemistData['chemist_id'])->delete();
        // Now add new contacts
        foreach($contact_nos as $contact_no){
            $contact = NEW ChemistContact();
            $contact->chemist_id = $chemistData['chemist_id'];
            $contact->contact_no = $contact_no['contact_no'];
            $contact->save();
        }

        /*
         * Save chemist address
         */
        // First delete address for this chemist
        ChemistAddress::where('chemist_id',$chemistData['chemist_id'])->delete();
        // Now add new address
        $address = NEW ChemistAddress();
        $address->chemist_id = $chemist->chemist_id;
        $address->address_line1	 = $chemistData['address_line1'];
        $address->address_line2	 = $chemistData['address_line2'];
        $address->division	 = $chemistData['division']	;
        $address->district	 = $chemistData['district']	;
        $address->thana	 = $chemistData['thana']	;
        $address->zip	 = $chemistData['zip']	;
        $address->save();

        /*
         * Adding chemist contact numbers
         */
        $contact_nos = json_decode($chemistData['contact_no'],true);
        // First delete territiry for this chemist
        ChemistTerritory::where('chemist_id',$chemistData['chemist_id'])->delete();
        // Now add new territory
        //$territories = json_decode($chemistData['territories'],true);
        $territories = $chemistData['territories'];
        foreach($territories as $ter){
            $territory = NEW ChemistTerritory();
            $territory->chemist_id = $chemistData['chemist_id'];
            $territory->territory_id = $ter;
            $contact->save();
        }

        // Adding chemist special days
        $special_days = json_decode($chemistData['special_days'],true);
        // First delete special days for this chemist
        ChemistSpecialDay::where('chemist_id',$chemistData['chemist_id'])->delete();
        // Now add new special days
        foreach($special_days as $special_day){
            $specialDay = NEW ChemistSpecialDay();
            $specialDay->chemist_id = $chemistData['chemist_id'];
            $specialDay->special_day_id = $special_day['special_day_id'];
            $specialDay->message = $special_day['message'];
            $specialDay->date = date('Y-m-d', strtotime($special_day['date']));
            $specialDay->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successful']);

    }

    public function details(Request $request){
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $chemist = Chemist::where('chemist_id',$request->chemist_id)->first();
        return json_encode(['status'=>200,'data'=>json_encode($chemist)]);
    }

    public function specialDayTypes(Request $request){
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $special_day_types = ChemistSpecialDayTypes::where('status','active')->get();
        return json_encode(['status'=>200,'data'=>$special_day_types]);
    }

    public function categories(Request $request){
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $categories = ChemistCategory::select('chemist_category_id as category_id','name')->where('status','active')->get();
        return json_encode(['status'=>200,'data'=>$categories]);
    }

    public function classes(Request $request){
        if($request->token !=Common::TOKEN_CHEMIST){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        $classes = DB::table('classes')->select('class_id','class_name')->where('type',2)->where('status','active')->get();
        return json_encode(['status'=>200,'data'=>$classes]);
    }
}
