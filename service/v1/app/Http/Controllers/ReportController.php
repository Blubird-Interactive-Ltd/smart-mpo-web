<?php

namespace App\Http\Controllers;

use App\Models\SpecialDays;
use App\Models\DoctorSpecialDay;
use App\Models\ChemistSpecialDay;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MPOTarget;
use App\Models\DoctorDcr;
use App\Models\Doctor;
use App\Models\Prescription;
use App\Common;
use DB;

/*
 * 1. Prescription report
 * url: http://202.125.76.60/service/v1/report/prescription
 * parameters: {token,user_id,oauth_token}
 *
 * 1. Prescription report
 * url: http://202.125.76.60/service/v1/report/prescription/reject_details
 * parameters: {token,oauth_token,date}
 *
 * 2. special Day Count for calendar
 * url: http://202.125.76.60/service/v1/calendar/special_day_count
 * parameters: {token,user_id,oauth_token}
 *
 * 2. calendar Day Details
 * url: http://202.125.76.60/v1/calendar/calendar_day_details
 * parameters: {token,oauth_token,date}
 *
 * 3. Get MPO targets
 * url: http://202.125.76.60/service/v1/target/get
 * parameters: {token,oauth_token,mpo_id}
 *
 * */

class ReportController extends Controller
{
    public function index(){

    }

    /**
     * @param Request $request
     * @return array
     */
    public function prescription(Request $request){
        if($request->token !=Common::TOKEN_REPORT){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->user_id ==''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/
        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');

        $targets = MPOTarget::where('mpo_id',$request->user_id)
            ->where('target_start_date',$first_day)
            ->where('mpo_targets.target_type_id',1)   // 1= prescription
            //->join('target_types','target_types.target_type_id','=','mpo_targets.target_type_id')
            ->get();

        $prescription_target = 0;
        foreach($targets as $key=>$value){
            $prescription_target = $value->unit;
        }

        $rawQuery = "SELECT created_at as date, SUM(CASE WHEN status='accepted' THEN 1 ELSE 0 END) as accepted, SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as rejected, SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending, SUM(1) as total FROM prescriptions WHERE user_id = ".$request->user_id." AND created_at >= '".$first_day."' AND created_at <= '".$last_day."' GROUP BY created_at DESC";

        $prescriptions = DB::select($rawQuery);
        $total_accepted = 0;
        foreach($prescriptions as $prescription){
            $total_accepted = $total_accepted+$prescription->accepted;
        }
        if(count($prescriptions)==0){
            return json_encode(['status'=>200,'target'=>$prescription_target,'total_accepted'=>$total_accepted,'data'=>array()]);
        }

        return json_encode(['status'=>200,'target'=>$prescription_target,'total_accepted'=>$total_accepted,'data'=>$prescriptions]);

    }
    public function prescriptionRejectDetails(Request $request){
        if($request->token !=Common::TOKEN_REPORT){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->date ==''){
            return json_encode(['status'=>401,'reason'=>'Date required']);
        }
        $date = date('Y-m-d',strtotime($request->date));

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        //$prescriptions = DB::select($rawQuery);
        $prescriptions = DB::table('prescriptions')->select('prescriptions.created_at as date','prescriptions.status','prescriptions.reject_reason','doctors.name as doctor_name','classes.class_name as doctor_class')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->join('classes','classes.class_id','=','doctors.class_id')
            ->where('prescriptions.status','rejected')
            ->where('prescriptions.user_id',$user->id)
            ->where('created_at',$date)
            ->get();
        if(count($prescriptions)==0){
            return json_encode(['status'=>200,'data'=>array()]);
        }

        return json_encode(['status'=>200,'data'=>$prescriptions]);

    }

    public function specialDayCount(Request $request){

        if($request->token !=Common::TOKEN_REPORT){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->user_id ==''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        // Get Thanas
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
        }
        else{
            $thanas = User::select('territories.thana_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->groupBy('location_id')
                ->pluck('territories.thana_id')->toArray();
        }
        $thana_list = implode(',',$thanas);

        // Get territories

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
        $territory_list = implode(',',$territories);

        $start_date = date('Y-m-01');
        //$start_date = date('m-01');
        $end_date = date('Y-m-t');
        //$end_date = date('m-t');

        $rawQuery = "SELECT date,SUM(1) as total FROM system_special_days WHERE date >= '".$start_date."' AND date <= '".$end_date."' GROUP BY date";
        $system_special_days = DB::select($rawQuery);
        //return $system_special_days;

        /*$rawQuery2 = "SELECT date,SUM(1) as total FROM doctor_special_days
                    JOIN doctors ON doctors.doctor_id = doctor_special_days.doctor_id  
                    JOIN doctor_chambers ON doctor_chambers.doctor_id = doctors.doctor_id 
                    WHERE doctor_chambers.thana IN(1,2,3) 
                    AND DATE_FORMAT(date, '%m-%d') >= DATE_FORMAT('".$start_date."', '%m-%d') 
                    AND DATE_FORMAT(date, '%m-%d') <= DATE_FORMAT('".$end_date."', '%m-%d') 
                    GROUP BY date";*/
        $rawQuery2 = "SELECT date,SUM(1) as total FROM doctor_special_days 
                    JOIN doctors ON doctors.doctor_id = doctor_special_days.doctor_id 
                    JOIN doctor_chambers ON doctor_chambers.doctor_id = doctors.doctor_id 
                    WHERE doctor_chambers.thana IN($thana_list)
                    AND date >= '".$start_date."' 
                    AND date <= '".$end_date."' 
                    GROUP BY date";
        $doctor_special_days = DB::select($rawQuery2);

        $rawQuery3 = "SELECT date,SUM(1) as total FROM chemist_special_days 
                      JOIN chemists ON chemists.chemist_id = chemist_special_days.chemist_id 
                      JOIN chemist_territories ON chemist_territories.chemist_id = chemists.chemist_id 
                      WHERE chemist_territories.territory_id IN($territory_list)
                      AND date >= '".$start_date."' 
                      AND date <= '".$end_date."' GROUP BY date";
        $chemist_special_days = DB::select($rawQuery3);

        $final_array = array_merge($system_special_days, $doctor_special_days, $chemist_special_days);

        $sumArray = array();
        foreach ($final_array as $subArray) {
            $day = date('d',strtotime($subArray->date));
            $date = date('m/d/Y',strtotime($subArray->date));
            if(isset($sumArray[$date])){
                $sumArray[$date] = $sumArray[$date]+$subArray->total;
            }
            else{
                $sumArray[$date] = $subArray->total;
            }
        }
        $counterArray = array();
        foreach ($sumArray as $key=>$value) {
            $c_data['month'] = date('F',strtotime($key));
            $c_data['date'] = $key;
            $c_data['monthInNum'] = $value;
            array_push($counterArray,$c_data);
        }
        return json_encode(['status'=>200,'data'=>$counterArray]);
    }

    public function calendarDayDetails(Request $request){

        if($request->token !=Common::TOKEN_REPORT){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->date ==''){
            return json_encode(['status'=>401,'reason'=>'Date required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            //return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $date = date('Y-m-d', strtotime($request->date));
        $messages = array();

        $system_special_days = SpecialDays::where('date',$date)->get();
        foreach($system_special_days as $sp_days){
            $sp_day['type'] = $sp_days->name;
            $sp_day['message'] = $sp_days->message;
            array_push($messages,$sp_day);
        }

        $doctor_special_days = DoctorSpecialDay::select('doctor_special_days.*','doctor_special_day_types.name')->where('date',$date)
            ->join('doctor_special_day_types','doctor_special_day_types.doctor_special_day_type_id','=','doctor_special_days.special_day_id')
            ->join('doctors','doctors.doctor_id','=','doctor_special_days.doctor_id')
            ->get();
        foreach($doctor_special_days as $d_days){
            $sp_day['type'] = $d_days->name;
            $sp_day['message'] = $d_days->message;
            array_push($messages,$sp_day);
        }

        $chemist_special_days = ChemistSpecialDay::select('chemist_special_days.*','chemist_special_day_types.name')->where('date',$date)
            ->join('chemist_special_day_types','chemist_special_day_types.chemist_special_day_type_id','=','chemist_special_days.special_day_id')
            ->join('chemists','chemists.chemist_id','=','chemist_special_days.chemist_id')
            ->get();
        foreach($chemist_special_days as $c_days){
            $sp_day['type'] = $c_days->name;
            $sp_day['message'] = $c_days->message;
            array_push($messages,$sp_day);
        }
        return json_encode(['status'=>200,'data'=>$messages]);
    }



    public function getTargets(Request $request){
        if($request->token !=Common::TOKEN_REPORT){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($request->mpo_id ==''){
            return json_encode(['status'=>401,'reason'=>'MPO ID required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(count($user)==0){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');

        $data_array = array();

        $targets = MPOTarget::where('mpo_id',$request->mpo_id)
            ->where('target_start_date',$first_day)
            ->where('target_types.name','!=','prescription')
            ->join('target_types','target_types.target_type_id','=','mpo_targets.target_type_id')
            ->get();
        if(count($targets)==0){ // If no target found
            $targets = [
                '0' => [
                    'unit' => 0,
                    'name' => 'visit'
                ],
                '1' => [
                    'unit' => 0,
                    'name' => 'collection'
                ],
                '2' => [
                    'unit' => 0,
                    'name' => 'order'
                ]
            ];
            $targets = array_map(function($array){ // Converting target array to object
                return (object)$array;
            }, $targets);
        }

        foreach($targets as $key=>$value){
            if($value->name=='visit'){
                $dcr = DoctorDcr::where('user_id',$request->mpo_id)
                    ->where('created_at','>=',$first_day." 00:00:01")
                    ->where('created_at','<=',$last_day." 23:59:59")
                    ->get();
                $data = array(
                    'target'=>$value->unit,
                    'actual'=>count($dcr),
                );
                $data_array['visit'] = $data;
            }
            if($value->name=='order'){
                $orders = DB::table('chemist_dcr')->select(DB::raw('SUM(order_value) as total_order'))
                    ->where('user_id',$request->mpo_id)
                    ->where('created_at','>=',$first_day." 00:00:01")
                    ->where('created_at','<=',$last_day." 23:59:59")
                    ->first();
                $data = array(
                    'target'=>$value->unit,
                    'actual'=>$orders->total_order,
                    'actual'=>($orders->total_order == null ? 0 : $orders->total_order),
                );
                $data_array['order'] = $data;
            }
            if($value->name=='collection'){
                $collections = DB::table('chemist_dcr')->select(DB::raw('SUM(collection) as total_collection'))
                    ->where('user_id',$request->mpo_id)
                    ->where('created_at','>=',$first_day." 00:00:01")
                    ->where('created_at','<=',$last_day." 23:59:59")
                    ->first();
                $data = array(
                    'target'=>$value->unit,
                    'actual'=>$collections->total_collection,
                    'actual'=>($collections->total_collection == null ? 0 : $collections->total_collection),
                );
                $data_array['collection'] = $data;
            }
        }

        return json_encode(['status'=>200,'data'=>$data_array]);
    }
}
