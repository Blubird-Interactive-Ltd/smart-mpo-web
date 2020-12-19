<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\models\Chemist;
use App\models\ChemistCategory;
use App\models\ChemistContact;
use App\models\ChemistTerritory;
use App\models\ChemistAddress;
use App\models\ChemistSpecialDay;
use App\models\ChemistSpDateType;
use Session;
use DB;
use Auth;
use App\Utility;

class ChemistController extends Controller
{

    /* Chemist details view by ajax */
    public function chemistReviewData(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),5)){
            return redirect('404_page');
        }

        $data['page'] = 'Chemist';

        $chemist = Chemist::with('contacts')
            ->with('chemist_address')
            ->join('chemist_territories','chemist_territories.chemist_id','=','chemists.chemist_id')
            ->where('chemists.chemist_id',$request->chemist_id)
            ->first();

        $special_days = ChemistSpecialDay::where('chemist_id',$chemist->chemist_id)
            ->join('chemist_special_day_types','chemist_special_day_types.chemist_special_day_type_id','=','chemist_special_days.special_day_id')
            ->get();
        $request_data = DB::table('chemist_edit_requests')
            ->where('chemist_id',$request->chemist_id)
            ->first();    

        $chemist->special_days = $special_days;
        return ['status'=>200, 'chemist'=>$chemist,'request_data'=>$request_data];
    }

    /* Chemist details Reject ajax */
    public function rejectEditRequest(Request $request){
        try{
        DB::beginTransaction();
        $chemist = Chemist::where('chemist_id',$request->chemist_id)->first();
        $chemist->status = 'active';
        $chemist->is_edit_request = 0;
        $chemist->save();
        /*Deleting edit request row*/
        DB::table('chemist_edit_requests')->where('chemist_id',$request->chemist_id)->delete();

        DB::commit();
        return ['status'=>200,'reason'=>'Change request rejected','val'=>'Success'];
        }catch(\Exception $e){
            DB::rollback();
            return ['status'=>401, 'reson'=>$e->getMessage()];
        }
    }

    
    /* Chemist view by ajax */
    public function chemistList(){
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),14)){
            return redirect('404_page');
        }

        $data['page'] = 'Chemist';

        $data['divisions'] = DB::table('address_divisions')->get();
        $data['territories'] = DB::table('territories')->where('status','Active')->get();
        $data['categories'] = DB::table('chemist_categories')->where('status','active')->get();
        $data['classes'] = DB::table('classes')->where('status','active')->get();
        $data['special_day_types'] = DB::table('chemist_special_day_types')->where('status','active')->get();
        $chemists = Chemist::select('chemists.*','classes.class_name','chemist_categories.name as category_name')
            ->leftJoin('classes','chemists.class_id','classes.class_id')
            ->leftJoin('chemist_categories','chemist_categories.chemist_category_id','chemists.category_id')
            ->where('chemists.status','!=','rejected')
            ->orderBy('chemists.chemist_id','DESC')
            ->paginate(100);

        foreach($chemists as $key=>$value){
            $contacts = ChemistContact::where('chemist_id',$value->chemist_id)->get();
            $territories = ChemistTerritory::where('chemist_id',$value->chemist_id)
                ->join('territories','territories.territory_id','=','chemist_territories.territory_id')
                ->get();
            $chemists[$key]->contacts = $contacts;
            $chemists[$key]->territories = $territories;
        }
        $data['chemists'] = $chemists;
        $data['pagination'] = $chemists->render();
        return view('chemist.manage_chemist',$data);
    }

    public function getChemist(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }

        if ($request->search_string !='') {
            $chemists = Chemist::select('chemists.*','users.first_name','users.last_name', 'classes.class_name', 'chemist_categories.name as category_name')
                ->leftJoin('classes', 'chemists.class_id', 'classes.class_id')
                ->leftJoin('users','users.id','chemists.created_by')
                ->leftJoin('chemist_categories', 'chemist_categories.chemist_category_id', 'chemists.category_id')
                ->where('chemists.status', '!=', 'rejected')
                ->where('chemists.name','like','%'.$request->search_string.'%')
                ->orderBy('chemists.chemist_id', 'DESC')
                ->paginate(100);
        }
        else {
            $chemists = Chemist::select('chemists.*','users.first_name','users.last_name', 'classes.class_name', 'chemist_categories.name as category_name')
                ->leftJoin('classes', 'chemists.class_id', 'classes.class_id')
                ->leftJoin('users','users.id','chemists.created_by')
                ->leftJoin('chemist_categories', 'chemist_categories.chemist_category_id', 'chemists.category_id')
                ->where('chemists.status', '!=', 'rejected')
                ->orderBy('chemists.chemist_id', 'DESC')
                ->paginate(100);
        }

        foreach($chemists as $key=>$value){
            $contacts = ChemistContact::where('chemist_id',$value->chemist_id)->get();
            $territories = ChemistTerritory::where('chemist_id',$value->chemist_id)
                ->join('territories','territories.territory_id','=','chemist_territories.territory_id')
                ->get();
            $chemists[$key]->contacts = $contacts;
            $chemists[$key]->territories = $territories;
        }
        $data['pagination'] = $chemists->render();

        return ['status'=>200,'val'=>$chemists,'pagination'=>view('pagination',$data)->render()];
    }


    /**
     * Chemist Store return View function.
     */
    public function chemistStore(Request $request){
        $chemist = Input::all();
        $result = Input::all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'territory' => 'required',
            'category' => 'required',
            'class' => 'required',

        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
        }else{

            try{
                DB::beginTransaction();

                $name = Utility::sanitize_string($request->name);
                $category = Utility::sanitize_number( $request->category);
                $class = Utility::sanitize_number( $request->class);

                //Chemist store
                $chemist = NEW Chemist();
                $chemist->name = $name;
                $chemist->category_id = $category;
                $chemist->class_id = $class;
                $chemist->created_by = 1;
                $chemist->save();
                $chemist_id = $chemist->chemist_id;


                /*
                 * Adding chemist territories
                 */
                $territories = $request->territory;
                $territory = NEW ChemistTerritory();
                $territory->chemist_id = $chemist_id;
                $territory->territory_id = $territories;
                $territory->save();

                /*
                 * Adding chemist contact numbers
                 */
                $contact_nos = $request->contact;
                foreach($contact_nos as $key => $contact_no){
                    if($contact_no !='') {
                        $contact = NEW ChemistContact();
                        $contact->chemist_id = $chemist_id;
                        $contact->contact_no = $contact_no;
                        $contact->save();
                    }
                }

                /*
                 * Save chemist address
                 */
                $chemist_address = $request->chemist_address1;
                foreach($chemist_address as $key => $address){
                    if($chemist_address[$key] !='') {
                        $address = NEW ChemistAddress();
                        $address->chemist_id = $chemist_id;
                        $address->address_line1	 = $chemist_address[$key];
                        $address->address_line2	 = '';
                        $address->division	= $request->chemist_division[$key];
                        $address->district	= $request->chemist_district[$key];
                        $address->thana	 = $request->chemist_thana[$key];
                        $address->zip	 = $request->chemist_zip[$key];
                        $address->save();
                    }
                }

                /*
                 * Adding chemist special days
                 */
                $special_days = $request->special_day_type;
                $special_day_dates = $request->special_day_date;
                if(!empty($special_days)) {
                    foreach ($special_days as $key => $special_day) {
                        $specialDay = NEW ChemistSpecialDay();
                        $specialDay->chemist_id = $chemist->chemist_id;
                        $specialDay->special_day_id = $request->special_day_type[$key];
                        $specialDay->message = $request->remark[$key];
                        $specialDay->date = date('Y-m-d', strtotime($special_day_dates[$key]));
                        $specialDay->save();
                    }
                }

                DB::commit();
                return ['status'=>200,'reason'=>'Chemist successfully saved','val'=>'Success'];

            }catch(\Exception $e){
                DB::rollback();
                return ['status'=>401, 'reson'=>$e->getMessage()];
            }
        }
        //return json_encode(['val'=>$doctor]);
    }

    public function chemistDetails(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Chemist';

        $data['chemist'] = Chemist::select('chemists.*','classes.class_name','chemist_categories.name as category_name')->with('contacts')
            ->join('classes','classes.class_id','=','chemists.class_id')
            ->join('chemist_categories','chemist_categories.chemist_category_id','=','chemists.category_id')
            ->where('chemists.chemist_id',$request->id)
            ->first();

        $territories = ChemistTerritory::where('chemist_id',$data['chemist']->chemist_id)
            ->join('territories','territories.territory_id','=','chemist_territories.territory_id')
            ->get();

        $special_days = ChemistSpecialDay::where('chemist_id',$data['chemist']->chemist_id)
            ->join('chemist_special_day_types','chemist_special_day_types.chemist_special_day_type_id','=','chemist_special_days.special_day_id')
            ->get();

        $chemist_address = ChemistAddress::where('chemist_id',$data['chemist']->chemist_id)
            ->join('address_divisions','address_divisions.division_id','=','chemist_address.division')
            ->join('address_districts','address_districts.district_id','=','chemist_address.district')
            ->join('address_thanas','address_thanas.thana_id','=','chemist_address.thana')
            ->join('address_zips','address_zips.zip_id','=','chemist_address.zip')
            ->get();

        $data['chemist']->territories = $territories;
        $data['chemist']->special_days = $special_days;
        $data['chemist']->chemist_address = $chemist_address;
        return view('chemist.chemist_details',$data);
    }

    /* Chemist details view by ajax */
    public function chemistDetailAjax(Request $request){
        $chemist = Chemist::with('contacts')
            ->with('chemist_address')
            ->join('chemist_territories','chemist_territories.chemist_id','=','chemists.chemist_id')
            ->where('chemists.chemist_id',$request->chemist_id)
            ->first();

        $special_days = ChemistSpecialDay::where('chemist_id',$chemist->chemist_id)
            ->join('chemist_special_day_types','chemist_special_day_types.chemist_special_day_type_id','=','chemist_special_days.special_day_id')
            ->get();
        $chemist->special_days = $special_days;
        return ['status'=>200, 'chemist'=>$chemist];
    }

    public function chemistUpdate(Request $request){
        $chemist = Input::all();
        $result = Input::all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'territory' => 'required',
            'category' => 'required',
            'class' => 'required',

        ]);

        $chemist_id = $request->chemist_id;

        if (!$validator->passes()) {
            return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
        }else{

            try{
                DB::beginTransaction();

                $name = Utility::sanitize_string($request->name);
                $category = Utility::sanitize_number( $request->category);
                $class = Utility::sanitize_number( $request->class);

                //Chemist store
                $chemist = Chemist::where('chemist_id',$chemist_id)->first();
                $chemist->name = $name;
                $chemist->category_id = $category;
                $chemist->class_id = $class;
                $chemist->status = 'active';
                $chemist->is_edit_request = 0;
                $chemist->save();


                /*
                 * Adding chemist territories
                 */
                ChemistTerritory::where('chemist_id',$chemist_id)->delete();

                $territories = $request->territory;
                $territory = NEW ChemistTerritory();
                $territory->chemist_id = $chemist_id;
                $territory->territory_id = $territories;
                $territory->save();

                /*
                 * Adding chemist contact numbers
                 */
                ChemistContact::where('chemist_id',$chemist_id)->delete();
                $contact_nos = $request->contact;
                foreach($contact_nos as $key => $contact_no){
                    if($contact_no !='') {
                        $contact = NEW ChemistContact();
                        $contact->chemist_id = $chemist_id;
                        $contact->contact_no = $contact_no;
                        $contact->save();
                    }
                }

                /*
                 * Save chemist address
                 */
                ChemistAddress::where('chemist_id',$chemist_id)->delete();
                $chemist_address = $request->chemist_address1;
                foreach($chemist_address as $key => $address){
                    if($chemist_address[$key] !='') {
                        $address = NEW ChemistAddress();
                        $address->chemist_id = $chemist_id;
                        $address->address_line1	 = $chemist_address[$key];
                        $address->address_line2	 = '';
                        $address->division	= $request->chemist_division[$key];
                        $address->district	= $request->chemist_district[$key];
                        $address->thana	 = $request->chemist_thana[$key];
                        $address->zip	 = $request->chemist_zip[$key];
                        $address->save();
                    }
                }

                /*
                 * Adding chemist special days
                 */
                ChemistSpecialDay::where('chemist_id',$chemist_id)->delete();
                $special_days = $request->special_day_type;
                $special_day_dates = $request->special_day_date;
                if(!empty($special_days)) {
                    foreach ($special_days as $key => $special_day) {
                        $specialDay = NEW ChemistSpecialDay();
                        $specialDay->chemist_id = $chemist->chemist_id;
                        $specialDay->special_day_id = $request->special_day_type[$key];
                        $specialDay->message = $request->remark[$key];
                        $specialDay->date = date('Y-m-d', strtotime($special_day_dates[$key]));
                        $specialDay->save();
                    }
                }

                /*Deleting edit request row*/
                DB::table('chemist_edit_requests')
                    ->where('chemist_id',$chemist_id)->delete();

            DB::commit();

                return ['status'=>200,'reason'=>'Chemist successfully saved','val'=>'Success'];

            }catch(\Exception $e){
                DB::rollback();
                return ['status'=>401, 'reson'=>$e->getMessage()];
            }
        }
        //return json_encode(['val'=>$doctor]);
    }

    public function changeChemistStatus(Request $request){
        try{
            DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;

            $obj = Chemist::find($id);
            if($status == 1){
                $obj->status = 'active';
                $message = 'Chemist activated successfully';
            }
            if($status == 2){
                $obj->status = 'inactive';
                $message = 'Chemist dectivated successfully';
            }
            if($status == 4){
                $obj->status = 'rejected';
                $message = 'Chemist successfully rejected';
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
     * Chemist categories view function.
    */
    public function chemistCategory()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),39)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        return view('chemist.chemistCat',$data);
    }

    /**
     * Chemist categories get value function.
    */
    public function getChemistCategory()
    {   
        $result = ChemistCategory::orderBy('chemist_category_id','DESC')->get();
        return ['status'=>200,'reason'=>'Operation Success','val'=>$result];
    }


    /**
     * Chemist categories Store function.
    */
    public function ChemistCategoryStore(Request $request)
    {

    $validator = Validator::make($request->all(), ['name' => 'required']);

    if (!$validator->passes()) {    
        return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

            try{
            DB::beginTransaction();
                
                $name = Utility::sanitize_string($request->name);

                $obj = new ChemistCategory;
                $obj->name = $name;
                $result = $obj->save();
                if($result){
                    return ['status'=>200,'reason'=>'Chemist category added successfully','val'=>'Success'];
                }
            }catch(\Exception $e){ 
                DB::rollback();
            return ['status'=>200, 'reason'=>$e->getMessage()];
            }

        }
    }     

    /**
     * Chemist categories Edit val function.
    */
    public function ChemistGetEditVal(Request $request)
    {
        $id = $request->id;
        $result = ChemistCategory::where('chemist_category_id',$id)->first();
        return ['status'=>200,'reason'=>'success','val'=>$result];
    }

    /**
     * Chemist categories Update function.
    */
    public function ChemistCategoryUpdate(Request $request)
    { 
        $validator = Validator::make($request->all(), [ 'name' => 'required' ]);

    if (!$validator->passes()) {    
        return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

            try{
            DB::beginTransaction();
                
                $name = Utility::sanitize_string($request->name);
                $id = $request->id;

                $obj = ChemistCategory::find($id);
                $obj->name = $name;
                $result = $obj->save();
                if($result){
                    return ['status'=>200,'reason'=>'Chemist category updated successfully','val'=>'Success'];
                }
            }catch(\Exception $e){ 
                DB::rollback();
            return ['status'=>200, 'reason'=>$e->getMessage()];
            }

        }  
    }  


    /**
     * Chemist categories Update function.
    */
    public function delChemistCategory(Request $request)
    {
        try{
        DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;
            if($status == 2){ $reson = 'Chemist category inactive successfully'; }
            if($status == 1){ $reson = 'Chemist category active successfully'; }
            $obj = ChemistCategory::find($id);
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
     * Chemist Special date Type setup.==============================
    */

    #Chemist special date type view
    public function chemistSpDayType(Request $request){

        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),63)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        return view('chemist.special_day_type',$data);
    }

    #Chemist special date type view
    public function getChemistSpecialDayType(Request $request){
        $result = ChemistSpDateType::orderBy('chemist_special_day_type_id','DESC')->get();
        return ['status'=>200,'reason'=>'Success','val'=>$result];
    } 

    #Chemist special date type view
    public function ChemistSpecialDayStore(Request $request){
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if (!$validator->passes()) {    
            return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
        }else{

                try{
                DB::beginTransaction();
                    
                    $name = Utility::sanitize_string($request->name);

                    $obj = new ChemistSpDateType;
                    $obj->name = $name;
                    $result = $obj->save();
                    if($result){
                        return ['status'=>200,'reason'=>'Chemist special day added successfully','val'=>'Success'];
                    }
                }catch(\Exception $e){ 
                    DB::rollback();
                return ['status'=>200, 'reson'=>$e->getMessage()];
                }

            }
    } 

    #Chemist special date type view
    public function getChemistSpDayEditVal(Request $request){
        $id = $request->id;
        $result = ChemistSpDateType::where('chemist_special_day_type_id',$id)->first();
        return ['status'=>200,'reason'=>'success','val'=>$result];
    }    

    #Chemist special date type view
    public function ChemistSpecialDayTypeUpdate(Request $request)
    { 
        $validator = Validator::make($request->all(), [ 'name' => 'required' ]);

    if (!$validator->passes()) {    
        return response()->json(['status'=>401,'error'=>$validator->errors()->all()]);
    }else{

            try{
            DB::beginTransaction();
                
                $name = Utility::sanitize_string($request->name);
                $id = $request->id;

                $obj = ChemistSpDateType::find($id);
                $obj->name = $name;
                $result = $obj->save();
                if($result){
                    return ['status'=>200,'reason'=>'Chemist Special day type updated successfully','val'=>'Success'];
                }
            }catch(\Exception $e){ 
                DB::rollback();
            return ['status'=>200, 'reson'=>$e->getMessage()];
            }

        }  
    } 

    #Chemist special date type Active/Inactive
    public function delChemistSpecialDayType(Request $request)
    {
        try{
        DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;
            if($status == 2){ $reson = 'Chemist special day type inactive successfully'; }
            if($status == 1){ $reson = 'Chemist special day type active successfully'; }
            $obj = ChemistSpDateType::find($id);
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




}// End Chemist Controller
