<?php

namespace App\Http\Controllers;

use App\models\Area;
use App\models\Doctor;
use App\models\DoctorHomeAddress;
use App\models\DoctorContact;
use App\models\DoctorSpeciality;
use App\models\DoctorSpecialDay;
use App\models\Doctor_chamber;
use App\models\DoctorDcr;
use App\models\Chemist;
use App\models\ChemistContact;
use App\models\ChemistTerritory;
use App\models\ChemistAddress;
use App\models\ChemistSpecialDay;
use App\models\Prescription;
use App\models\Region;
use App\models\Territory;
use App\models\User;
use App\models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Session;
use DB;
use App\Utility;

class ReportController extends Controller
{

    /**
     * AM DCR report function.
     */
    public function amList(){
        if(!Auth::check()){
            return redirect('login');
        }
        /*if(!Utility::userRolePermission(Session::get('role_id'),22)){
            return redirect('404_page');
        }*/
        $data['page'] = 'Report';
        $data['areas'] = Area::where('status','Active')->get();

        if(Session::get('role_id')==3){ // If rsm logged in
            // Get all am ids associate with the rsm
            $all_am = User::select('id')->where('parent_id',Session::get('id'))->where('status','active')->pluck('id')->toArray();
        }
        else if(Session::get('role_id')==2){ // If zsm logged in
            // Get all rsm ids associate with the zsm
            $all_rsm = User::select('id')->where('parent_id',Session::get('id'))->where('status','active')->pluck('id')->toArray();
            // Get all am ids associate with the rsm
            $all_am = User::select('id')->whereIn('parent_id',$all_rsm)->pluck('id')->where('status','active')->toArray();
        }
        else{
            $all_am = User::select('id')->where('role_id',4)->where('status','active')->pluck('id')->toArray();
        }

        $data['ams'] = User::whereIn('id',$all_am)
            ->Leftjoin('areas','areas.area_id','=','users.location_id')
            ->where('role_id',4)->where('users.status','active')->get();

        /*if(Session::get('role_id')==4){
            $am_id = Session::get('id');
            $data['mpos'] = User::where('parent_id',$am_id)
                ->Leftjoin('territories','territories.territory_id','=','users.location_id')
                ->where('role_id',5)->where('users.status','active')->get();
        }
        else{
            $data['mpos'] = User::Leftjoin('territories','territories.territory_id','=','users.location_id')
                ->where('role_id',5)->where('users.status','active')->get();
        }*/

        return view('report.am_list',$data);
    }

    public function amReport(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),21)){
            return redirect('404_page');
        }
        $data['page'] = 'Report';
        $am_id = $request->id;
        $data['user_details'] = User::where('id', $am_id)
            ->Leftjoin('territories','territories.territory_id','=','users.location_id')
            ->first();
        if($request->date){
            $last_date = date('Y-m-d', strtotime($request->date));
        }
        else{
            $last_doctor_dcr = DB::table('doctor_dcr')->orderBy('created_at','desc')
                ->where('doctor_dcr.user_id',$am_id)
                ->limit(1)
                ->first();
            $last_chemist_dcr = DB::table('chemist_dcr')->orderBy('created_at','desc')
                ->where('chemist_dcr.user_id',$am_id)
                ->limit(1)
                ->first();
            if(!empty($last_doctor_dcr) && !empty($last_chemist_dcr)){ // if both date exists
                $d1 = new DateTime($last_doctor_dcr->created_at);
                $d2 = new DateTime($last_chemist_dcr->created_at);
                if($d1 == $d2){
                    $last_date = date('Y-m-d', strtotime($last_doctor_dcr->created_at));
                }
                if($d1 > $d2){
                    $last_date = date('Y-m-d', strtotime($last_doctor_dcr->created_at));
                }
                if($d1 < $d2){
                    $last_date = date('Y-m-d', strtotime($last_chemist_dcr->created_at));
                }

            }
            else if(!empty($last_doctor_dcr) && empty($last_chemist_dcr)){ // if only doctor dcr
                $last_date = date('Y-m-d', strtotime($last_doctor_dcr->created_at));
            }
            else if(empty($last_doctor_dcr) && !empty($last_chemist_dcr)){ // If only chemist dcr
                $last_date = date('Y-m-d', strtotime($last_chemist_dcr->created_at));
            }
            else{ // If none found
                $last_date = date('Y-m-d');
            }
        }

        $data['last_date'] = $last_date;
        $data['doctor_dcr'] = DB::table('doctor_dcr')
            ->select('doctor_dcr.*','users.first_name','users.last_name','doctors.name as doctor_name','doctors.qualification','users.user_id','territories.name as territory_name','classes.class_name')
            ->leftJoin('users','doctor_dcr.user_id','=','users.id')
            ->leftJoin('doctors','doctor_dcr.doctor_id','=','doctors.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->leftJoin('territories','users.location_id','=','territories.territory_id')
            ->where('doctor_dcr.user_id',$am_id)
            ->where('doctor_dcr.created_at','>=',$last_date." 00:00:00")
            ->where('doctor_dcr.created_at','<=',$last_date." 23:59:59")
            ->orderBy('doctor_dcr.doctor_dcr_id','DESC')
            ->get();

        $data['chemist_dcr'] = DB::table('chemist_dcr')
            ->select('chemist_dcr.*','chemists.name as chemist_name','chemist_categories.name as category')
            ->leftJoin('chemists','chemists.chemist_id','=','chemist_dcr.chemist_id')
            ->leftJoin('chemist_categories','chemist_categories.chemist_category_id','=','chemists.category_id')
            ->where('chemist_dcr.user_id',$am_id)
            ->where('chemist_dcr.created_at','>=',$last_date." 00:00:00")
            ->where('chemist_dcr.created_at','<=',$last_date." 23:59:59")
            ->orderBy('chemist_dcr.chemist_dcr_id','DESC')
            ->get();
        $contacts = array();
        foreach($data['doctor_dcr'] as $key=>$dcr){
            $contacts = DoctorContact::where('doctor_id',$dcr->doctor_id)->get();
            $specialities = DoctorSpeciality::select('specialities.name as speciality_name')->where('doctor_id',$dcr->doctor_id)
                ->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
                ->get();
            $visitors = DB::table('doctor_dcr_visit_team')->select('users.first_name','users.last_name')
                ->leftJoin('users','doctor_dcr_visit_team.team_member_id','=','users.id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $products = DB::table('doctor_dcr_products')->select('products.name as product_name')
                ->join('products','products.product_id','=','doctor_dcr_products.product_id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $samples = DB::table('doctor_dcr_sample_products')->select('quantity','products.name as product_name')
                ->join('products','products.product_id','=','doctor_dcr_sample_products.product_id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $ppms = DB::table('doctor_dcr_ppms')->select('ppms.name as ppm_name')
                ->join('ppms','ppms.ppm_id','=','doctor_dcr_ppms.ppm_id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $gifts = DB::table('doctor_dcr_gifts')->where('doctor_dcr_id',$dcr->doctor_dcr_id)->get();

            if($dcr->location !=''){
                $data['doctor_dcr'][$key]->location = $dcr->location;
            }
            else if($dcr->latitude=='' || $dcr->longitude==''){
                $data['doctor_dcr'][$key]->location = '';
            }
            else{
                $location = $this->getGeoLocation($dcr->latitude,$dcr->longitude);
                $data['doctor_dcr'][$key]->location = $location;
                $updateDcr = DoctorDcr::where('doctor_dcr_id',$dcr->doctor_dcr_id)->first();
                $updateDcr->location = $location;
                $updateDcr->save();
            }

            $data['doctor_dcr'][$key]->contacts = $contacts;
            $data['doctor_dcr'][$key]->specialities = $specialities;
            $data['doctor_dcr'][$key]->visitors = $visitors;
            $data['doctor_dcr'][$key]->products = $products;
            $data['doctor_dcr'][$key]->samples = $samples;
            $data['doctor_dcr'][$key]->ppms = $ppms;
            $data['doctor_dcr'][$key]->gifts = $gifts;

            foreach($data['chemist_dcr'] as $key=>$dcr){
                $contacts = ChemistContact::where('chemist_id',$dcr->chemist_id)->get();
                $data['chemist_dcr'][$key]->contacts = $contacts;
            }
        }
        $mpos = User::where('parent_id',$am_id)
            ->Leftjoin('territories','territories.territory_id','=','users.location_id')
            ->where('role_id',5)->where('users.status','active')->get();

        $data['mpos'] = $this->getTargets($mpos,$last_date);
        return view('report.am_report',$data);
        //echo "<pre>"; print_r($data['doctor_dcr']); echo "</pre>";
    }

    public function getTargets($mpos,$last_date){
        if(!Auth::check()){
            return redirect('login');
        }
        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');
        foreach($mpos as $key=>$mpo){
            /*Visit targets*/
            $visit_targets = DB::table('mpo_targets')->where('mpo_id',$mpo->id)
                ->where('target_start_date',$first_day)
                ->where('target_types.name','visit')
                ->join('target_types','target_types.target_type_id','=','mpo_targets.target_type_id')
                ->first();
            $dcr = DB::table('doctor_dcr')->where('user_id',$mpo->id)
                ->where('created_at','>=',$first_day." 00:00:01")
                ->where('created_at','<=',$last_day." 23:59:59")
                ->get();
            $today_dcr = DB::table('doctor_dcr')->where('user_id',$mpo->id)
                ->where('created_at','>=',$last_date." 00:00:01")
                ->where('created_at','<=',$last_date." 23:59:59")
                ->get();
            if(!empty($visit_targets)){
                $v_target = $visit_targets->unit;
            }
            else{
                $v_target = 0;
            }
            $mpo_data = array(
                'target'=>$v_target,
                'actual'=>count($dcr),
                'today'=>count($today_dcr),
            );
            $mpos[$key]->visits = $mpo_data;

            /*Order targets*/
            $order_targets = DB::table('mpo_targets')->where('mpo_id',$mpo->id)
                ->where('target_start_date',$first_day)
                ->where('target_types.name','order')
                ->join('target_types','target_types.target_type_id','=','mpo_targets.target_type_id')
                ->first();
            $orders = DB::table('chemist_dcr')->select(DB::raw('SUM(order_value) as total_order'))
                ->where('user_id',$mpo->id)
                ->where('created_at','>=',$first_day." 00:00:01")
                ->where('created_at','<=',$last_day." 23:59:59")
                ->first();
            $today_orders = DB::table('chemist_dcr')->select(DB::raw('SUM(order_value) as total_order'))
                ->where('user_id',$mpo->id)
                ->where('created_at','>=',$last_date." 00:00:01")
                ->where('created_at','<=',$last_date." 23:59:59")
                ->first();
            if(!empty($order_targets)){
                $o_target = $order_targets->unit;
            }
            else{
                $o_target = 0;
            }

            if($orders->total_order!=''){
                $total_order = $orders->total_order;
            }
            else{
                $total_order = 0;
            }

            if($today_orders->total_order!=''){
                $total_today_order = $today_orders->total_order;
            }
            else{
                $total_today_order = 0;
            }
            $mpo_data = array(
                'target'=>$o_target,
                'actual'=>$total_order,
                'today'=>$total_today_order,
            );
            $mpos[$key]->orders = $mpo_data;

            /*Collection targets*/
            $collection_targets = DB::table('mpo_targets')->where('mpo_id',$mpo->id)
                ->where('target_start_date',$first_day)
                ->where('target_types.name','order')
                ->join('target_types','target_types.target_type_id','=','mpo_targets.target_type_id')
                ->first();
            $collections = DB::table('chemist_dcr')->select(DB::raw('SUM(collection) as total_collection'))
                ->where('user_id',$mpo->id)
                ->where('created_at','>=',$last_date." 00:00:01")
                ->where('created_at','<=',$last_date." 23:59:59")
                ->first();
            $today_collections = DB::table('chemist_dcr')->select(DB::raw('SUM(collection) as total_collection'))
                ->where('user_id',$mpo->id)
                ->where('created_at','>=',$first_day." 00:00:01")
                ->where('created_at','<=',$last_date." 23:59:59")
                ->first();
            if(!empty($collection_targets)){
                $c_target = $collection_targets->unit;
            }
            else{
                $c_target = 0;
            }

            if($collections->total_collection!=''){
                $total_collection = $collections->total_collection;
            }
            else{
                $total_collection = 0;
            }

            if($today_collections->total_collection!=''){
                $total_today_collection = $today_collections->total_collection;
            }
            else{
                $total_today_collection = 0;
            }
            $mpo_data = array(
                'target'=>$c_target,
                'actual'=>$total_collection,
                'today'=>$total_today_collection,
            );
            $mpos[$key]->collections = $mpo_data;
        }
        return $mpos;
    }

    public function getChemisDcr(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }

        $from = $request->start;
        $to = $request->end;
        if($from == '' || $to==''){
            $data['chemistDcr'] = DB::table('chemist_dcr')
                ->select('chemist_dcr.*','users.first_name','users.last_name','chemists.name','users.user_id','territories.name as trrName','chemists.other_special_day')
                ->leftJoin('users','chemist_dcr.user_id','=','users.id')
                ->leftJoin('chemists','chemist_dcr.chemist_id','=','chemists.chemist_id')
                ->leftJoin('territories','users.location_id','=','territories.territory_id')
                ->orderBy('chemist_dcr.chemist_dcr_id','DESC')
                ->get();
        }else{
            $data['chemistDcr'] = DB::table('chemist_dcr')
                ->select('chemist_dcr.*','users.first_name','users.last_name','chemists.name','users.user_id','territories.name as trrName','chemists.other_special_day')
                ->leftJoin('users','chemist_dcr.user_id','=','users.id')
                ->leftJoin('chemists','chemist_dcr.chemist_id','=','chemists.chemist_id')
                ->leftJoin('territories','users.location_id','=','territories.territory_id')
                ->whereBetween('chemist_dcr.created_at',[$from,$to])
                ->orderBy('chemist_dcr.chemist_dcr_id','DESC')
                ->get();
        }
        return ['status'=>200,'val'=> $data];

    }

    /**
     * Doctor DCR report function.
     */

    public function mpoList(){
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),22)){
            return redirect('404_page');
        }
        $data['page'] = 'Report';
        $data['territories'] = Territory::where('status','Active')->get();

        $mpos = Utility::getMpos(Session::get('role_id'),Session::get('id'));

        $data['mpos'] = User::whereIn('id',$mpos)
            ->Leftjoin('territories','territories.territory_id','=','users.location_id')
            ->where('role_id',5)->where('users.status','active')->get();

        /*if(Session::get('role_id')==4){
            $am_id = Session::get('id');
            $data['mpos'] = User::where('parent_id',$am_id)
                ->Leftjoin('territories','territories.territory_id','=','users.location_id')
                ->where('role_id',5)->where('users.status','active')->get();
        }
        else{
            $data['mpos'] = User::Leftjoin('territories','territories.territory_id','=','users.location_id')
                ->where('role_id',5)->where('users.status','active')->get();
        }*/

        return view('report.mpoList',$data);
    }


    public function mpoReport(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),23)){
            return redirect('404_page');
        }
        $data['page'] = 'Report';

        $data['user_details'] = User::where('id', $request->id)
            ->Leftjoin('territories','territories.territory_id','=','users.location_id')
            ->first();
        if($request->date){
            $last_date = date('Y-m-d', strtotime($request->date));
        }
        else{
            $last_doctor_dcr = DB::table('doctor_dcr')->orderBy('created_at','desc')
                ->where('doctor_dcr.user_id',$request->id)
                ->limit(1)
                ->first();
            $last_chemist_dcr = DB::table('chemist_dcr')->orderBy('created_at','desc')
                ->where('chemist_dcr.user_id',$request->id)
                ->limit(1)
                ->first();
            if(!empty($last_doctor_dcr) && !empty($last_chemist_dcr)){ // if both date exists
                $d1 = new DateTime($last_doctor_dcr->created_at);
                $d2 = new DateTime($last_chemist_dcr->created_at);
                if($d1 == $d2){
                    $last_date = date('Y-m-d', strtotime($last_doctor_dcr->created_at));
                }
                if($d1 > $d2){
                    $last_date = date('Y-m-d', strtotime($last_doctor_dcr->created_at));
                }
                if($d1 < $d2){
                    $last_date = date('Y-m-d', strtotime($last_chemist_dcr->created_at));
                }

            }
            else if(!empty($last_doctor_dcr) && empty($last_chemist_dcr)){ // if only doctor dcr
                $last_date = date('Y-m-d', strtotime($last_doctor_dcr->created_at));
            }
            else if(empty($last_doctor_dcr) && !empty($last_chemist_dcr)){ // If only chemist dcr
                $last_date = date('Y-m-d', strtotime($last_chemist_dcr->created_at));
            }
            else{ // If none found
                $last_date = date('Y-m-d');
            }
        }

        $data['last_date'] = $last_date;
        $data['doctor_dcr'] = DB::table('doctor_dcr')
            ->select('doctor_dcr.*','users.first_name','users.last_name','doctors.name as doctor_name','doctors.qualification','users.user_id','territories.name as territory_name','classes.class_name')
            ->leftJoin('users','doctor_dcr.user_id','=','users.id')
            ->leftJoin('doctors','doctor_dcr.doctor_id','=','doctors.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->leftJoin('territories','users.location_id','=','territories.territory_id')
            ->where('doctor_dcr.user_id',$request->id)
            ->where('doctor_dcr.created_at','>=',$last_date." 00:00:00")
            ->where('doctor_dcr.created_at','<=',$last_date." 23:59:59")
            ->orderBy('doctor_dcr.doctor_dcr_id','DESC')
            ->get();

        $data['chemist_dcr'] = DB::table('chemist_dcr')
            ->select('chemist_dcr.*','chemists.name as chemist_name','chemist_categories.name as category')
            ->leftJoin('chemists','chemists.chemist_id','=','chemist_dcr.chemist_id')
            ->leftJoin('chemist_categories','chemist_categories.chemist_category_id','=','chemists.category_id')
            ->where('chemist_dcr.user_id',$request->id)
            ->where('chemist_dcr.created_at','>=',$last_date." 00:00:00")
            ->where('chemist_dcr.created_at','<=',$last_date." 23:59:59")
            ->orderBy('chemist_dcr.chemist_dcr_id','DESC')
            ->get();

        foreach($data['doctor_dcr'] as $key=>$dcr){
            $contacts = DoctorContact::where('doctor_id',$dcr->doctor_id)->get();
            $specialities = DoctorSpeciality::select('specialities.name as speciality_name')->where('doctor_id',$dcr->doctor_id)
                ->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
                ->get();
            $visitors = DB::table('doctor_dcr_visit_team')->select('users.first_name','users.last_name')
                ->leftJoin('users','doctor_dcr_visit_team.team_member_id','=','users.id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $products = DB::table('doctor_dcr_products')->select('products.name as product_name')
                ->join('products','products.product_id','=','doctor_dcr_products.product_id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $samples = DB::table('doctor_dcr_sample_products')->select('quantity','products.name as product_name')
                ->join('products','products.product_id','=','doctor_dcr_sample_products.product_id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $ppms = DB::table('doctor_dcr_ppms')->select('ppms.name as ppm_name')
                ->join('ppms','ppms.ppm_id','=','doctor_dcr_ppms.ppm_id')
                ->where('doctor_dcr_id',$dcr->doctor_dcr_id)
                ->get();
            $gifts = DB::table('doctor_dcr_gifts')->where('doctor_dcr_id',$dcr->doctor_dcr_id)->get();

            if($dcr->location !=''){
                $data['doctor_dcr'][$key]->location = $dcr->location;
            }
            else if($dcr->latitude=='' || $dcr->longitude==''){
                $data['doctor_dcr'][$key]->location = '';
            }
            else{
                $location = $this->getGeoLocation($dcr->latitude,$dcr->longitude);
                $data['doctor_dcr'][$key]->location = $location;
                $updateDcr = DoctorDcr::where('doctor_dcr_id',$dcr->doctor_dcr_id)->first();
                $updateDcr->location = $location;
                $updateDcr->save();
            }

            $data['doctor_dcr'][$key]->contacts = $contacts;
            $data['doctor_dcr'][$key]->specialities = $specialities;
            $data['doctor_dcr'][$key]->visitors = $visitors;
            $data['doctor_dcr'][$key]->products = $products;
            $data['doctor_dcr'][$key]->samples = $samples;
            $data['doctor_dcr'][$key]->ppms = $ppms;
            $data['doctor_dcr'][$key]->gifts = $gifts;
        }

        foreach($data['chemist_dcr'] as $key=>$dcr){
            $contacts = ChemistContact::where('chemist_id',$dcr->chemist_id)->get();
            $data['chemist_dcr'][$key]->contacts = $contacts;
        }
        return view('report.mpo_report',$data);
        //echo "<pre>"; print_r($data['dcr']); echo "</pre>";
    }

    public function getDoctorDcr(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }

        $from = $request->start;
        $to = $request->end;
        if($from == '' || $to==''){
            $data['dcr'] = DB::table('doctor_dcr')
                ->select('doctor_dcr.*','users.first_name','users.last_name','doctors.name','users.user_id','territories.name as trrName')
                ->leftJoin('users','doctor_dcr.user_id','=','users.id')
                ->leftJoin('doctors','doctor_dcr.doctor_id','=','doctors.doctor_id')
                ->leftJoin('territories','users.location_id','=','territories.territory_id')
                ->orderBy('doctor_dcr.doctor_dcr_id','DESC')
                ->get();
        }else{
            $data['dcr'] = DB::table('doctor_dcr')
                ->select('doctor_dcr.*','users.first_name','users.last_name','doctors.name','users.user_id','territories.name as trrName')
                ->leftJoin('users','doctor_dcr.user_id','=','users.id')
                ->leftJoin('doctors','doctor_dcr.doctor_id','=','doctors.doctor_id')
                ->leftJoin('territories','users.location_id','=','territories.territory_id')
                ->whereBetween('doctor_dcr.created_at',[$from,$to])
                ->orderBy('doctor_dcr.doctor_dcr_id','DESC')
                ->get();
        }
        return ['status'=>200,'val'=> $data];

    }




    #prescription report from am & mpo
    public function prescriptionReport(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Report';

        return view('report.prescription_report',$data);

    }

    public function searchPrescriptionReport(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Report';

        return view('report.prescription_report',$data);

    }

    #prescription report from mpo
    public function MpoPrescription(Request $request){
        $year = $request->year;
        $month = $request->month;

        $mpos = Utility::getMpos(Session::get('role_id'),Session::get('id'));

        #mpo report for prescription prepare
        $pres = DB::table('prescriptions')->select(DB::raw('COUNT(user_id) as count,user_id'))
                    ->whereIn('user_id', $mpos)
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->groupBy('user_id')->get();

        if(!empty($pres)){
            foreach ($pres as $key => $p) {                
                $mpo = DB::table('users')->select('users.first_name','users.last_name','territories.name as trName','user_am.first_name as amFname','user_am.last_name as amLname','users.hr_port','users.id','user_am.id as am_id')
                        ->leftJoin('territories','users.location_id','territories.territory_id')
                        ->leftJoin('users as user_am','users.parent_id','user_am.id')
                        ->where('users.id',$p->user_id)->first();
                if (!empty($mpo)) {
                    $pData[$key]['id'] =  $mpo->id;   
                    $pData[$key]['mpoName'] =  $mpo->first_name.' '.$mpo->last_name;
                    $pData[$key]['hr'] =  $mpo->hr_port;  
                    $pData[$key]['amName'] =  $mpo->amFname.' '.$mpo->amLname;   
                    $pData[$key]['trName'] =  $mpo->trName;
                    $pData[$key]['am_id'] =  $mpo->am_id;

                    $accepted = DB::table('prescriptions')->where('status','accepted')
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->where('user_id',$mpo->id)->get();
                    $rejected = DB::table('prescriptions')->where('status','rejected')
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->where('user_id',$mpo->id)->get();
                    $target = DB::table('mpo_targets')->select('unit')->where('mpo_id',$mpo->id)
                        ->where('target_type_id',1)
                        ->whereYear('target_start_date', '=', $year)
                        ->whereMonth('target_start_date', '=', $month)    
                        ->first();

                    $pData[$key]['accepted'] =  count($accepted);
                    $pData[$key]['rejected'] =  count($rejected);
                    $pData[$key]['totalAdd'] =  (count($accepted) + count($rejected));
                    if (!empty($target)) {
                        $pData[$key]['target'] =  $target->unit;
                    }else{
                        $pData[$key]['target'] =  0;
                    }

                    if ($pData[$key]['target']>0) {
                       $pData[$key]['percentage'] =  (count($accepted)*100)/( $pData[$key]['target']);
                    }else{
                        $pData[$key]['percentage'] =  0;
                    } 
                }            
            }
        }
        else{
            $pData = [];
        }

        $ams = Utility::getAms(Session::get('role_id'),Session::get('id'));
        #am report for prescription prepare
        $pres = DB::table('prescriptions')->select(DB::raw('COUNT(user_id) as count,user_id'))
            ->whereIn('user_id', $ams)
            ->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->groupBy('user_id')->get();

        if(!empty($pres)){
            foreach ($pres as $key => $p) {
                $am = DB::table('users')->select('users.first_name','users.last_name','areas.area_name as arName','user_rsm.first_name as rsmFname','user_rsm.last_name as rsmLname','users.hr_port','users.id','user_rsm.id as rsm_id')
                    ->leftJoin('areas','users.location_id','areas.area_id')
                    ->leftJoin('users as user_rsm','users.parent_id','user_rsm.id')
                    ->where('users.id',$p->user_id)->first();
                if (!empty($am)) {
                    $aData[$key]['id'] =  $am->id;
                    $aData[$key]['amName'] =  $am->first_name.' '.$am->last_name;
                    $aData[$key]['hr'] =  $am->hr_port;
                    $aData[$key]['rsmName'] =  $am->rsmFname.' '.$am->rsmLname;
                    $aData[$key]['arName'] =  $am->arName;
                    $aData[$key]['rsm_id'] =  $am->rsm_id;

                    $accepted = DB::table('prescriptions')->where('status','accepted')
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->where('user_id',$am->id)
                        ->get();
                    $rejected = DB::table('prescriptions')->where('status','rejected')
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->where('user_id',$am->id)
                        ->get();
                    $target = DB::table('mpo_targets')->select('unit')
                        ->where('mpo_id',$am->id)
                        ->where('target_type_id',1)
                        ->whereYear('target_start_date', '=', $year)
                        ->whereMonth('target_start_date', '=', $month)
                        ->first();

                    $aData[$key]['accepted'] =  count($accepted);
                    $aData[$key]['rejected'] =  count($rejected);
                    $aData[$key]['totalAdd'] =  (count($accepted) + count($rejected));
                    if (!empty($target)) {
                        $aData[$key]['target'] =  $target->unit;
                    }else{
                        $aData[$key]['target'] =  0;
                    }

                    if ($aData[$key]['target']>0) {
                        $aData[$key]['percentage'] =  (count($accepted)*100)/( $pData[$key]['target']);
                    }else{
                        $aData[$key]['percentage'] =  0;
                    }
                }
            }
        }
        else{
            $aData = [];
        }

        $data['mpoPres'] = $pData;
        $data['amPres'] = $aData;

        return ['status'=>200,'data'=> $data];
    }

    #prescription report from mpo
    public function MpoPrescriptionFilter(Request $request){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));

        $mpos = Utility::getMpos(Session::get('role_id'),Session::get('id'));

        #mpo report for prescription prepare
        $pres = DB::table('prescriptions')->select(DB::raw('COUNT(user_id) as count,user_id'))
                    ->whereIn('user_id', $mpos)
                    ->where('created_at', '>=', $start_date)
                    ->where('created_at', '<=', $end_date)
                    ->groupBy('user_id')->get();

        if(count($pres)){
            foreach ($pres as $key => $p) {
                $mpo = DB::table('users')->select('users.first_name','users.last_name','territories.name as trName','user_am.first_name as amFname','user_am.last_name as amLname','users.hr_port','users.id','user_am.id as am_id')
                        ->leftJoin('territories','users.location_id','territories.territory_id')
                        ->leftJoin('users as user_am','users.parent_id','user_am.id')
                        ->where('users.id',$p->user_id)->first();
                if (!empty($mpo)) {
                    $pData[$key]['id'] =  $mpo->id;
                    $pData[$key]['mpoName'] =  $mpo->first_name.' '.$mpo->last_name;
                    $pData[$key]['hr'] =  $mpo->hr_port;
                    $pData[$key]['amName'] =  $mpo->amFname.' '.$mpo->amLname;
                    $pData[$key]['trName'] =  $mpo->trName;
                    $pData[$key]['am_id'] =  $mpo->am_id;

                    $accepted = DB::table('prescriptions')->where('status','accepted')
                        ->where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)
                        ->where('user_id',$mpo->id)->get();
                    $rejected = DB::table('prescriptions')->where('status','rejected')
                        ->where('created_at', '>=', $start_date)
                        ->where('created_at', '<=', $end_date)
                        ->where('user_id',$mpo->id)->get();
                    $target = DB::table('mpo_targets')->select('unit')->where('mpo_id',$mpo->id)
                        ->where('target_type_id',1)
                        ->where('target_start_date', '=', $start_date)
                        ->where('target_start_date', '=', $end_date)
                        ->first();

                    $pData[$key]['accepted'] =  count($accepted);
                    $pData[$key]['rejected'] =  count($rejected);
                    $pData[$key]['totalAdd'] =  (count($accepted) + count($rejected));
                    if (!empty($target)) {
                        $pData[$key]['target'] =  $target->unit;
                    }else{
                        $pData[$key]['target'] =  0;
                    }

                    if ($pData[$key]['target']>0) {
                       $pData[$key]['percentage'] =  (count($accepted)*100)/( $pData[$key]['target']);
                    }else{
                        $pData[$key]['percentage'] =  0;
                    }
                }
            }
        }else{ $pData = [];}

        #mpo report for prescription prepare
        $am = DB::table('users')->select('users.first_name','users.last_name','areas.area_name as arName','user_sm.first_name as smFname','user_sm.last_name as smLname','users.hr_port','users.id','user_sm.id as sm_id')
                ->leftJoin('areas','users.location_id','areas.area_id')
                ->leftJoin('users as user_sm','users.parent_id','user_sm.id')
                ->where('users.role_id',4)->get();


        if(count($am)>0){
            foreach ($am as $key => $a) {
                $accepted = 0;
                $rejected = 0;
                $target = 0;
                $totalAdd = 0;
                $percentage = 0;
                $count = 0;
                    foreach ($pData as $key2 => $value) {
                        if($pData[$key2]['am_id'] == $a->id){
                            $accepted = $accepted + $pData[$key2]['accepted'];
                            $rejected = $rejected + $pData[$key2]['rejected'];
                            $target = $target + $pData[$key2]['target'];
                            $totalAdd = $totalAdd + $pData[$key2]['totalAdd'];
                            $percentage = $percentage + $pData[$key2]['percentage'];
                            $count++;
                        }
                    }
                $aData[$key]['accepted'] = $accepted;
                $aData[$key]['rejected'] = $rejected;
                $aData[$key]['target'] = $target;
                $aData[$key]['totalAdd'] = $totalAdd;
                $aData[$key]['percentage'] = $percentage;

                $aData[$key]['amName'] =  $a->first_name.' '.$a->last_name;
                $aData[$key]['hr'] =  $a->hr_port;
                $aData[$key]['smName'] =  $a->smFname.' '.$a->smLname;
                $aData[$key]['arName'] =  $a->arName;
            }

            if($count == 0){$aData = [];}

        }else{ $aData = []; }

        $data['mpoPres'] = $pData;
        $data['amPres'] = $aData;

        return ['status'=>200,'data'=> $data];
    }

    private function getGeoLocation($latitude,$longitude){
        try{
            //$geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=48.283273,14.295041&sensor=false');
            $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=false');
            $output= json_decode($geocode);
            if(isset($output->results[0])){
                return $output->results[0]->formatted_address;
            }
            else{
                return '';
            }
        }
        catch (Exception $e) {
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
            return  '';
        }
    }

    public function getDoctorDetailAjax(Request $request){
        $data['doctor'] = Doctor::select('doctors.*','classes.class_name')
            ->with('contacts')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->where('doctor_id',$request->doctor_id)
            ->first();
        
        $special_days = DoctorSpecialDay::where('doctor_id',$data['doctor']->doctor_id)
            ->join('doctor_special_day_types','doctor_special_day_types.doctor_special_day_type_id','=','doctor_special_days.special_day_id')
            ->get();

        $specialities = DoctorSpeciality::where('doctor_id',$data['doctor']->doctor_id)
            ->join('specialities','specialities.speciality_id','=','doctor_specialities.speciality_id')
            ->get();

        $chambers_address = Doctor_chamber::where('doctor_id',$data['doctor']->doctor_id)
            ->join('address_divisions','address_divisions.division_id','=','doctor_chambers.division')
            ->join('address_districts','address_districts.district_id','=','doctor_chambers.district')
            ->join('address_thanas','address_thanas.thana_id','=','doctor_chambers.thana')
            ->join('address_zips','address_zips.zip_id','=','doctor_chambers.zip')
            ->get();
        $home_address = DoctorHomeAddress::where('doctor_id',$data['doctor']->doctor_id)
            ->join('address_divisions','address_divisions.division_id','=','doctor_home_address.division')
            ->join('address_districts','address_districts.district_id','=','doctor_home_address.district')
            ->join('address_thanas','address_thanas.thana_id','=','doctor_home_address.thana')
            ->join('address_zips','address_zips.zip_id','=','doctor_home_address.zip')
            ->get();

        $data['doctor']->special_days = $special_days;
        $data['doctor']->doctor_specialities = $specialities;
        $data['doctor']->chambers = $chambers_address;
        $data['doctor']->home_address = $home_address;

        return ['status'=>200,'reason'=>'','doctor'=>$data['doctor']];
    }

    public function getChemistDetailAjax(Request $request){
        $data['chemist'] = Chemist::select('chemists.*','classes.class_name','chemist_categories.name as category_name')->with('contacts')
            ->join('classes','classes.class_id','=','chemists.class_id')
            ->join('chemist_categories','chemist_categories.chemist_category_id','=','chemists.category_id')
            ->where('chemists.chemist_id',$request->chemist_id)
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

        return ['status'=>200,'reason'=>'','chemist'=>$data['chemist']];
    }

    // Zone report
    public function zoneReport(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Report';

        $today_date = date('Y-m-d');
        if($request->date){
            $current_date = date('Y-m-d',strtotime($request->date));
            $today = strtotime (date($request->date));
            $this_month_first_day = date('Y-m-01',$today);
            $this_month_last_day = date('Y-m-t',$today);

            $timestamp = strtotime (date('Y-m-d', strtotime(date('Y',strtotime ($request->date)).'-'.date('m',strtotime ($request->date)).'-00')));

            $last_month_first_day  =  date("Y-m-01",$timestamp);
            $last_month_last_day  =  date("Y-m-t",$timestamp);

            $day = $this->check_month_last_day(date('d',strtotime($request->date)),$last_month_last_day);
            $last_month_current_date = date('Y-m', $timestamp)."-".$day;
            Session::put('zone_report_date',date($request->date));
            Session::put('zone_report_last_month_date',date($last_month_current_date));
        }
        else{
            $current_date = date('Y-m-d');
            $today = strtotime (date('Y-m-d'));
            $this_month_first_day = date('Y-m-01',$today);
            $this_month_last_day = date('Y-m-t',$today);

            $timestamp = strtotime (date('Y-m-d', strtotime(date('Y').'-'.date('m').'-00')));
            $last_month_first_day  =  date("Y-m-01",$timestamp);
            $last_month_last_day  =  date("Y-m-t",$timestamp);

            $day = $this->check_month_last_day(date('d'),$last_month_last_day);
            $last_month_current_date = date('Y-m', strtotime(date('Y-m-d')." -1 month"))."-".$day;
            Session::put('zone_report_date',date('m/d/Y'));
            Session::put('zone_report_last_month_date',date($last_month_current_date));
        }
        $zones = User::select('users.id as zsm_id','users.first_name','users.last_name','zones.*')
            ->join('zones','zones.zone_id','users.location_id')
            ->where('users.role_id',2)
            ->where('users.status','active')
            ->where('zones.status','Active')
            ->get();
        //echo "<pre>"; print_r($zones); echo "</pre>";
        foreach($zones as $key=>$zone){
            $regions = User::select('users.id as rsm_id','users.first_name','users.last_name','regions.*')
                ->join('regions','regions.region_id','users.location_id')
                ->where('users.parent_id',$zone->zsm_id)
                ->where('users.role_id',3)
                ->where('users.status','active')
                ->where('regions.status','Active')
                ->get();
            foreach($regions as $key2=>$region){
                $mpos = User::select('users.*')
                    ->join('users as am','am.id','=','users.parent_id')
                    ->join('users as rsm', function($join) use ($region){
                        $join->on('rsm.id', '=', 'am.parent_id');
                        $join->on('rsm.id','=',DB::raw($region->rsm_id));
                    })
                    ->where('users.role_id',5)
                    ->get();
                $ams = User::select('users.*')
                    ->where('users.role_id',4)
                    ->where('parent_id',$region->rsm_id)
                    ->get();

                $all_mpo = User::select('users.id')
                    ->join('users as am','am.id','=','users.parent_id')
                    ->join('users as rsm', function($join) use ($region){
                        $join->on('rsm.id', '=', 'am.parent_id');
                        $join->on('rsm.id','=',DB::raw($region->rsm_id));
                    })
                    ->where('users.role_id',5)
                    ->pluck('users.id')
                    ->toArray();

                $all_am = User::select('users.id')
                    ->join('users as rsm', function($join) use ($region){
                        $join->on('rsm.id', '=', 'users.parent_id');
                        $join->on('rsm.id','=',DB::raw($region->rsm_id));
                    })
                    ->where('users.role_id',4)
                    ->pluck('users.id')
                    ->toArray();
                $users = array_merge($all_mpo,$all_am);
                $rx_users = implode(',',$users);

                if(count($users)>0){
                    $rawQuery = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id IN(".$rx_users.") AND created_at = '".$today_date."'";
                    $todays_prescriptions = DB::select($rawQuery);

                    $rawQuery2 = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id IN(".$rx_users.") AND created_at = '".$current_date."'";
                    $current_date_prescriptions = DB::select($rawQuery2);

                    $rawQuery3 = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id IN(".$rx_users.") AND created_at >= '".$this_month_first_day."' AND created_at <= '".$current_date."'";
                    $this_month_prescriptions = DB::select($rawQuery3);

                    $rawQuery4 = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id IN(".$rx_users.") AND created_at >= '".$last_month_first_day."' AND created_at <= '".$last_month_current_date."'";
                    $last_month_prescriptions = DB::select($rawQuery4);

                    $rawQuery5 = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id IN(".$rx_users.") AND created_at >= '".$last_month_first_day."' AND created_at <= '".$last_month_last_day."'";
                    $last_month_total_prescriptions = DB::select($rawQuery5);
                }
                else{
                    // Make all blank object
                    $todays_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                    $current_date_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                    $this_month_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                    $last_month_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                    $last_month_total_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                }

                $regions[$key2]->mpos = count($mpos);
                $regions[$key2]->ams = count($ams);
                $regions[$key2]->prescription_today = $todays_prescriptions;
                $regions[$key2]->current_date_prescriptions = $current_date_prescriptions;
                $regions[$key2]->prescription_this_month = $this_month_prescriptions;
                $regions[$key2]->prescription_last_month = $last_month_prescriptions;
                $regions[$key2]->prescription_last_month_total = $last_month_total_prescriptions;
            }

            $zones[$key]->regions = $regions;

        }
        $data['zones'] = $zones;
        $data['last_date'] = $current_date;

        return view('report.zone_report',$data);
        //echo "<pre>"; print_r($zones); echo "</pre>";

    }

    // Report Activity
    public function reportActivity(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Report';

        if($request->date){
            $current_date = date('Y-m-d',strtotime($request->date));
        }
        else{
            $current_date = date('Y-m-d');
        }
        $zones = User::select('users.id as zsm_id','users.first_name','users.last_name','zones.*')
            ->join('zones','zones.zone_id','users.location_id')
            ->where('users.role_id',2)
            ->where('users.status','active')
            ->where('zones.status','Active')
            ->get();
        foreach($zones as $key=>$zone){
            $regions = User::select('users.id as rsm_id','users.first_name','users.last_name','regions.*')
                ->join('regions','regions.region_id','users.location_id')
                ->where('users.parent_id',$zone->zsm_id)
                ->where('users.role_id',3)
                ->where('users.status','active')
                ->where('regions.status','Active')
                ->get();
            foreach($regions as $key2=>$region){
                $mpos = User::select('users.*')
                    ->join('users as am','am.id','=','users.parent_id')
                    ->join('users as rsm', function($join) use ($region){
                        $join->on('rsm.id', '=', 'am.parent_id');
                        $join->on('rsm.id','=',DB::raw($region->rsm_id));
                    })
                    ->where('users.role_id',5)
                    ->get();
                $ams = User::select('users.*')
                    ->where('users.role_id',4)
                    ->where('parent_id',$region->rsm_id)
                    ->get();

                $all_mpo = User::select('users.id')
                    ->join('users as am','am.id','=','users.parent_id')
                    ->join('users as rsm', function($join) use ($region){
                        $join->on('rsm.id', '=', 'am.parent_id');
                        $join->on('rsm.id','=',DB::raw($region->rsm_id));
                    })
                    ->where('users.role_id',5)
                    ->pluck('users.id')
                    ->toArray();

                $all_am = User::select('users.id')
                    ->join('users as rsm', function($join) use ($region){
                        $join->on('rsm.id', '=', 'users.parent_id');
                        $join->on('rsm.id','=',DB::raw($region->rsm_id));
                    })
                    ->where('users.role_id',4)
                    ->pluck('users.id')
                    ->toArray();
                $users = array_merge($all_mpo,$all_am);
                $rx_users = implode(',',$users);

                if(count($users)>0){
                    $rawQuery2 = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id IN(".$rx_users.") AND created_at = '".$current_date."'";
                    $current_date_prescriptions = DB::select($rawQuery2);
                }
                else{
                    // Make all blank object
                    $todays_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                    $current_date_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                }

                $regions[$key2]->mpos = count($mpos);
                $regions[$key2]->ams = count($ams);
                $regions[$key2]->current_date_prescriptions = $current_date_prescriptions;
            }

            $zones[$key]->regions = $regions;

        }
        $data['zones'] = $zones;
        $data['last_date'] = $current_date;

        return view('report.report_activity',$data);

    }

    public function reportActivityDetailAjax(Request $request){
        $current_date = date('Y-m-d',strtotime($request->date));
        $zone = User::select('users.id as zsm_id','users.first_name','users.last_name','zones.*')
            ->join('zones','zones.zone_id','users.location_id')
            ->where('users.id',$request->zsm_id)
            ->where('users.role_id',2)
            ->where('users.status','active')
            ->where('zones.status','Active')
            ->first();

        $regions = User::select('users.id as rsm_id','users.first_name','users.last_name','regions.*')
            ->join('regions','regions.region_id','users.location_id')
            ->where('users.parent_id',$zone->zsm_id)
            ->where('users.role_id',3)
            ->where('users.status','active')
            ->where('regions.status','Active')
            ->get();
        foreach($regions as $key2=>$region){
            $mpos = User::select('users.*')
                ->join('users as am','am.id','=','users.parent_id')
                ->join('users as rsm', function($join) use ($region){
                    $join->on('rsm.id', '=', 'am.parent_id');
                    $join->on('rsm.id','=',DB::raw($region->rsm_id));
                })
                ->where('users.role_id',5)
                ->get();
            foreach($mpos as $mpoKey=>$value){
                $rawQuery = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id = ".$value->id." AND created_at = '".$current_date."'";
                $mpo_prescriptions = DB::select($rawQuery);
                $mpos[$mpoKey]->prescriptions = $mpo_prescriptions;
            }
            $ams = User::select('users.*')
                ->where('users.role_id',4)
                ->where('parent_id',$region->rsm_id)
                ->get();
            foreach($ams as $amKey=>$value){
                $rawQuery1 = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id = ".$value->id." AND created_at = '".$current_date."'";
                $am_prescriptions = DB::select($rawQuery1);
                $ams[$amKey]->prescriptions = $am_prescriptions;
            }

            $all_mpo = User::select('users.id')
                ->join('users as am','am.id','=','users.parent_id')
                ->join('users as rsm', function($join) use ($region){
                    $join->on('rsm.id', '=', 'am.parent_id');
                    $join->on('rsm.id','=',DB::raw($region->rsm_id));
                })
                ->where('users.role_id',5)
                ->pluck('users.id')
                ->toArray();

            $all_am = User::select('users.id')
                ->join('users as rsm', function($join) use ($region){
                    $join->on('rsm.id', '=', 'users.parent_id');
                    $join->on('rsm.id','=',DB::raw($region->rsm_id));
                })
                ->where('users.role_id',4)
                ->pluck('users.id')
                ->toArray();
            $users = array_merge($all_mpo,$all_am);
            $rx_users = implode(',',$users);

            if(count($users)>0){
                $rawQuery2 = "SELECT SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id IN(".$rx_users.") AND created_at = '".$current_date."'";
                $current_date_prescriptions = DB::select($rawQuery2);
            }
            else{
                // Make all blank object
                $todays_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
                $current_date_prescriptions = array((object) array('accepted'=>0,'rejected'=>0,'pending'=>0,'total'=>0));
            }

            $regions[$key2]->mpos = count($mpos);
            $regions[$key2]->ams = count($ams);
            $regions[$key2]->mpo_list = $mpos;
            $regions[$key2]->am_list = $ams;
            $regions[$key2]->current_date_prescriptions = $current_date_prescriptions;
        }

        $zone->regions = $regions;

        return ['status'=>200,'reason'=>'','zone'=>$zone];
    }

    // Order Collection
    public function reportOrder(Request $request){
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Report';
        if($request->date){
            $date_from = date('Y-m-d 00:00:01',strtotime($request->date));
            $date_to = date('Y-m-d 23:59:59',strtotime($request->date));
            Session::put('report_order_date',date($request->date));
        }
        else{
            $date_from = date('Y-m-d 00:00:01');
            $date_to = date('Y-m-d 23:59:59');
            Session::put('report_order_date',date('m/d/Y'));
        }
        $data['chemist_dcr'] = DB::table('chemist_dcr')->select(DB::raw('SUM(order_value) as total_order'),DB::raw('SUM(collection) as total_collection'))
            ->where('created_at','>=',$date_from)
            ->where('created_at','<=',$date_to)
            ->first();

        return view('report.report_order',$data);

    }

    public static function check_month_last_day($day,$last_month_last_day){
        $last_day = date("d", strtotime($last_month_last_day));
        if($day>$last_day){
            return $last_day;
        }
        return $day;
    }

}// End Of report controller
