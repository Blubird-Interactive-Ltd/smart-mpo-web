<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Utility;
use Carbon\Carbon;

class dashboardController extends Controller
{



    /**
     * dashboard View function.
    */
    public function index()
    {
    	if(!Auth::check()){
            return redirect('login');
        }
        
        $val['page'] = 'Dashboard';
        $dataArray = [];
	    $topDoctor = [];	
	    $topProDoc = [];
	    $prescription = [];
        
    	#Data prepare for top ten product
    	$product = DB::table('products')->select('product_id')->get();
    	$dpro = DB::table('doctor_dcr_products')->select(DB::raw('COUNT(product_id) as count,product_id'))->groupBy('product_id')->get();
    	$chpro = DB::table('chemist_dcr_products')
   							->select(DB::raw('COUNT(product_id) as count,product_id'))
   							->groupBy('product_id')->get();
				
   		foreach ($product as $key => $value) { $dval = 0; $chval = 0; 

   			foreach ($dpro as $key2 => $dp) { 
		 		if($value->product_id === $dp->product_id){
		 			$dval = $dp->count;
		 		}
	 		}

	 		foreach ($chpro as $key3 => $chp) {
		 		if($value->product_id === $chp->product_id){
		 			$chval = $chp->count;
		 		}
	 		}

	 		$hit = ($dval + $chval);

	 		if($hit>0){
		 		$dataArray[$key]['id'] = $value->product_id;
		 		$dataArray[$key]['count'] = $hit;
		 		$pro = DB::table('products')->select('name')
		 					->where('product_id',$value->product_id)->first();
		 		$dataArray[$key]['pro'] = $pro->name;
	 		}

   		}				
		if(isset($dataArray)){
			$count = array();
			foreach ($dataArray as $key => $row)
			{
			    $count[$key] = $row['count'];
			}
			array_multisort($count, SORT_DESC, $dataArray);
		}

	#Data prepare for top ten Doctor
	$topDoc = DB::table('prescriptions')
			->select(DB::raw('COUNT(doctor_id) as count,doctor_id'))
			->where('status','accepted')
			->groupBy('doctor_id')->get();
	foreach ($topDoc as $key => $doc) {
		$doctor = DB::table('doctors')->select('name')->where('doctor_id',$doc->doctor_id)->first();
		if(!empty($doctor)){
			$topDoctor[$key]['docName'] = $doctor->name;
			$topDoctor[$key]['count'] = $doc->count;
		}
	}
	if(isset($topDoctor)){
		$count = array();
		foreach ($topDoctor as $key => $row)
		{
		    $count[$key] = $row['count'];
		}
		array_multisort($count, SORT_DESC, $topDoctor);
	}

	#Data prepare for top ten Doctor
	$proByDoc = DB::table('prescription_details')
			->select(DB::raw('COUNT(prescription_details.product_id) as count,prescription_details.product_id'))
			->leftJoin('prescriptions','prescriptions.prescription_id','prescription_details.prescription_id')
			->where('prescriptions.status','accepted')
			->groupBy('prescription_details.product_id')->get(); 

	if(isset($proByDoc)){		
		foreach ($proByDoc as $key => $docPro) {
			$proDoctor = DB::table('products')->select('name')->where('product_id',$docPro->product_id)->first();
			if(!empty($proDoctor)){
				$topProDoc[$key]['proName'] = $proDoctor->name;
				$topProDoc[$key]['count'] = $docPro->count;
			}
		}
	}else{ $topProDoc = []; }

	if(isset($topProDoc)){
		$count = array();
		foreach ($topProDoc as $key => $row)
		{
		    $count[$key] = $row['count'];
		}
		array_multisort($count, SORT_DESC, $topProDoc);
	}

	#Data prepare for division wise prescriptions

        $div = DB::table('address_divisions')->select('division_id','division_name')->get();
        if (isset($div)) {
            foreach ($div as $key => $d) {
                $pres = DB::table('prescriptions')
                    ->where('division_id',$d->division_id)
                    ->where('status','accepted')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->get();
                $prescription[$key]['divName'] = $d->division_name;
                $prescription[$key]['count'] = count($pres);
            }

        }else{ $prescription = []; }

		 //echo '<pre>';print_r($prescription);echo '<pre>'; exit();

    
	    $val['topProduct'] = $dataArray;
	    $val['topDoctor'] = $topDoctor;	
	    $val['topProByDoc'] = $topProDoc;
	    $val['prescription'] = $prescription;	
		return view('dashboard.dashboard',$val);
    }



}
