<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Terget;
use App\models\Territory;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;
use App\Utility;
use DB;
use Auth;

class TergetController extends Controller
{

	/* Terget View function */
	public function viewTerget(){
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),26)){
            return redirect('404_page');
        }
        $data['page'] = 'Setting';

        $data['mpoList'] = User::where('status','active')->where('role_id',5)->get();
		$data['territories'] = Territory::where('status','Active')->orderBy('territory_id','DESC')->get();
		return view('terget.terget_setup',$data);
	}

	/* Terget get function */
	public function getTergetList(Request $request){

		$month 	= $request->month;
		$year 	= $request->year;
		$date = $year.'-'.$month.'-'.'01';


		$mpo = Terget::select('mpo_id')->groupBy('mpo_id')->where('target_start_date',$date)->get();
		if(count($mpo )>0){
			foreach ($mpo as $key => $m) {
				$id[] = $m->mpo_id;
			}
		}else{
			$id = [];
		}

		if(count($id)>0){
            $mpo =	user::select('users.first_name','users.last_name','users.id','users.user_id','users.hr_port','territories.name as trName')
                        ->leftJoin('territories','users.location_id','territories.territory_id')
                        ->whereIn('id',$id)
                        ->get();

            foreach ($mpo as $key => $m) {
                $data[$key]['id'] = $m->id;
                $data[$key]['fname'] = $m->first_name;
                $data[$key]['lname'] = $m->last_name;
                $data[$key]['hr_code'] = $m->hr_port;
                $data[$key]['trName'] = $m->trName;
                $data[$key]['user_id'] = $m->user_id;

                $target = Terget::select('mpo_targets.*','users.first_name as crFname','users.last_name as crLname')
                ->leftJoin('users','mpo_targets.created_by','users.id')
                ->where('mpo_targets.mpo_id',$m->id)->where('mpo_targets.target_start_date',$date)->get();
                $data[$key]['p_target'] = $target[0]->unit;
                $data[$key]['d_target'] = $target[1]->unit;
                $data[$key]['or_target'] = $target[3]->unit;
                $data[$key]['col_target'] = $target[2]->unit;
                $data[$key]['crFname'] = $target[0]->crFname;
                $data[$key]['crLname'] = $target[0]->crLname;
            }


		}else{
			$data = [];
		}

		// foreach ($id as $key => $val) {
		// 	$result = Terget::where('mpo_id',$val)->get();
		// 	foreach ($result as $key2 => $val2) {
		// 		$details[$key2] = $result;
		// 	}
		// 	$data['mpo']->details = $details;
		// }

		// foreach ($data['mpo'] as $key => $mpo) {
		// 	$data['id'] = $mpo->mpo_id;
		// 	$result = Terget::where('mpo_id',$mpo->mpo_id)->get();
		// 	foreach ($result as $key => $re) {
		// 		$data['start'][$key] = $re->target_start_date;
		// 		$data['end'][$key] = $re->target_end_date;
		// 	}
		// }
		return ['status'=>200,'val'=>$data];
	}

	/* Terget get function */
	public function storeTerget(Request $request){

		$type = $request->type;
		$year = $request->year;
		$month = $request->month;
		$date = $year.'-'.$month.'-'.'01';

		$check = Terget::where('mpo_id',$request->mpo)->where('target_start_date',$date)->get();
		if (count($check)>0) {
			return ['status'=>401, 'reason'=>'This monthly terget already exist !!'];
		}

		foreach ($type as $key => $val) {
			$obj = new Terget;
			$obj->mpo_id = $request->mpo;
			$obj->target_start_date = $date;
			$obj->target_type_id = $request->type[$key];
			$obj->unit = $request->terget[$key];
			$obj->created_by = 58;
			$obj->created_at = date('Y-m-d');
			$obj->save();
		}
		return ['status'=>200, 'reason'=>'Target added successfully'];
	}



	/* Terget View function */
	public function getEditVal(Request $request){
		$year = $request->year;
		$month = $request->month;
		$date = $year.'-'.$month.'-'.'01';

		$editVal = Terget::where('mpo_id',$request->id)->where('target_start_date',$date)->get();
		if (count($editVal)>0) {
			return ['status'=>200, 'reason'=>'Success','val'=>$editVal];
		}else{ return ['status'=>401, 'reason'=>'Success','val'=>$editVal]; }
		
	}

	/* Terget View function */
	public function updateTerget(Request $request){

	try{
   	DB::beginTransaction();
   		$type = $request->type;
		$old_id = $request->old_id;
		$old_year = $request->old_year;
		$old_month = $request->old_month;
		$old_date = $old_year.'-'.$old_month.'-'.'01';

		$year = $request->year;
		$month = $request->month;
		$date = $year.'-'.$month.'-'.'01';

		if($old_date != $date){
			$check = Terget::where('mpo_id',$old_id)->where('target_start_date',$date)->get();
			if (count($check)>0) {
				return ['status'=>401, 'reason'=>'This monthly terget already exist !!'];
			}
		}

		Terget::where('mpo_id',$old_id)->where('target_start_date',$date)->delete();

		foreach ($type as $key => $val) {
			$obj = new Terget;
			$obj->mpo_id = $old_id;
			$obj->target_start_date = $date;
			$obj->target_type_id = $request->type[$key];
			$obj->unit = $request->terget[$key];
			$obj->created_by = 58;
			$obj->created_at = date('Y-m-d');
			$obj->save();
		}

		DB::commit();
		return ['status'=>200, 'reason'=>'Target updated successfully'];
	        }catch(\Exception $e){ 	
	        DB::rollback();
	        return ['status'=>200, 'reason'=>$e->getMessage()];
	    }  	

	}



	

	





} //End Target Controller
