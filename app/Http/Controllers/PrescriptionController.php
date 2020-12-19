<?php

namespace App\Http\Controllers;

use App\models\Area;
use App\models\Territory;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Utility;
use App\models\Product;
use App\models\Prescription;
use App\models\PrescriptionDetail;
use App\models\PrescriptionImage;
use Validator;
use Session;
use DB;
use Auth;


class PrescriptionController extends Controller
{

    /**
     * Product View function.
     */
    public function index(Request $request)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),18)){
            return redirect('404_page');
        }

        if($request->filter_mpo && $request->filter_mpo!=''){
            $mpos = array();
            array_push($mpos,$request->filter_mpo);
            Session::put('filter_mpo',$request->filter_mpo);
        }
        else{
            //$mpos = Utility::getMpos(Session::get('role_id'),Session::get('id'));
            $mpos = User::select('id')->where('status','active')->whereIn('role_id',[4,5])->pluck('id')->toArray();
            Session::put('filter_mpo','');
        }
        $my_mpos = Utility::getMpos(Session::get('role_id'),Session::get('id'));
        $data['mpos'] = User::select('users.*','territories.name as territory_name')
            ->whereIn('id',$my_mpos)
            ->where('users.status','active')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->get();

        $data['page'] = 'Prescription';
        Session::put('search_string','');

        $data['prescriptions'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereIn('prescriptions.user_id',$mpos)
            ->orderBy('prescription_id','desc')
            ->paginate(50);
        foreach($data['prescriptions'] as $key=>$prescription){
            if($prescription->role_id==4){ // If user AM
                $location = Area::where('area_id',$prescription->location_id)->first();
                $data['prescriptions'][$key]->territory = $location->code;
            }
            else{ // If user MPO
                $location = Territory::where('territory_id',$prescription->location_id)->first();
                $data['prescriptions'][$key]->territory = $location->name;
            }

        }

        $data['prescriptions_accept'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereIn('prescriptions.user_id',$mpos)
            ->where('prescriptions.status','accepted')
            ->orderBy('prescription_id','desc')
            ->paginate(50);
        foreach($data['prescriptions_accept'] as $key=>$prescription){
            if($prescription->role_id==4){ // If user AM
                $location = Area::where('area_id',$prescription->location_id)->first();
                $data['prescriptions_accept'][$key]->territory = $location->code;
            }
            else{ // If user MPO
                $location = Territory::where('territory_id',$prescription->location_id)->first();
                $data['prescriptions_accept'][$key]->territory = $location->name;
            }

        }

        $data['prescriptions_pending'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereIn('prescriptions.user_id',$mpos)
            ->where('prescriptions.status','pending')
            ->orderBy('prescription_id','desc')
            ->paginate(50);
        foreach($data['prescriptions_pending'] as $key=>$prescription){
            if($prescription->role_id==4){ // If user AM
                $location = Area::where('area_id',$prescription->location_id)->first();
                $data['prescriptions_pending'][$key]->territory = $location->code;
            }
            else{ // If user MPO
                $location = Territory::where('territory_id',$prescription->location_id)->first();
                $data['prescriptions_pending'][$key]->territory = $location->name;
            }

        }

        $data['prescriptions_reject'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereIn('prescriptions.user_id',$mpos)
                ->where('prescriptions.status','rejected')
            ->orderBy('prescription_id','desc')
            ->paginate(50);
        foreach($data['prescriptions_reject'] as $key=>$prescription){
            if($prescription->role_id==4){ // If user AM
                $location = Area::where('area_id',$prescription->location_id)->first();
                $data['prescriptions_reject'][$key]->territory = $location->code;
            }
            else{ // If user MPO
                $location = Territory::where('territory_id',$prescription->location_id)->first();
                $data['prescriptions_reject'][$key]->territory = $location->name;
            }

        }
        
        $data['pending_count'] = Prescription::where('prescriptions.status','pending')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereIn('prescriptions.user_id',$mpos)
            ->get();

        Session::put('start_date','');
        Session::put('end_date','');
        return view('report.prescription',$data);
        //echo "<pre>"; print_r($data['prescriptions']); echo "</pre>";
    }

    public function searchPrescription(Request $request)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),18)){
            return redirect('404_page');
        }

        $mpos = Utility::getMpos(Session::get('role_id'),Session::get('id'));

        $data['page'] = 'Prescription';
        $type = $request->type;
        Session::put('search_string',$request->search_text);

        if($request->search_text!=''){
            $data['prescriptions'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                /*->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->join('products','products.product_id','=','prescriptions.product_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->orderBy('prescription_id','desc')
                ->paginate(50);*/

            ->with('products')
                ->with('images')
                ->join('prescription_details','prescription_details.prescription_id','=','prescriptions.prescription_id')
                ->join('products','products.product_id','=','prescription_details.product_id')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->join('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->orderBy('prescription_id','desc')
                ->groupBy('prescriptions.prescription_id')
                ->paginate(50);
            foreach($data['prescriptions'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions'][$key]->territory = $location->name;
                }

            }

            $data['prescriptions_accept'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                /*->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->join('products','products.product_id','=','prescriptions.product_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->where('prescriptions.status','accepted')
                ->orderBy('prescription_id','desc')
                ->paginate(50);*/

            ->with('products')
                ->with('images')
                ->join('prescription_details','prescription_details.prescription_id','=','prescriptions.prescription_id')
                ->join('products','products.product_id','=','prescription_details.product_id')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->join('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->where('prescriptions.status','accepted')
                ->orderBy('prescription_id','desc')
                ->groupBy('prescriptions.prescription_id')
                ->paginate(50);
            foreach($data['prescriptions_accept'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions_accept'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions_accept'][$key]->territory = $location->name;
                }

            }

            $data['prescriptions_pending'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                /*->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->join('products','products.product_id','=','prescriptions.product_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->where('prescriptions.status','pending')
                ->orderBy('prescription_id','desc')
                ->paginate(50);*/

            ->with('products')
                ->with('images')
                ->join('prescription_details','prescription_details.prescription_id','=','prescriptions.prescription_id')
                ->join('products','products.product_id','=','prescription_details.product_id')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->join('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->where('prescriptions.status','pending')
                ->orderBy('prescription_id','desc')
                ->groupBy('prescriptions.prescription_id')
                ->paginate(50);
            foreach($data['prescriptions_pending'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions_pending'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions_pending'][$key]->territory = $location->name;
                }

            }

            $data['prescriptions_reject'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                /*->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->join('products','products.product_id','=','prescriptions.product_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->where('prescriptions.status','rejected')
                ->orderBy('prescription_id','desc')
                ->paginate(50);*/

            ->with('products')
                ->with('images')
                ->join('prescription_details','prescription_details.prescription_id','=','prescriptions.prescription_id')
                ->join('products','products.product_id','=','prescription_details.product_id')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->join('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->where('prescriptions.status','rejected')
                ->orderBy('prescription_id','desc')
                ->groupBy('prescriptions.prescription_id')
                ->paginate(50);
            foreach($data['prescriptions_reject'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions_reject'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions_reject'][$key]->territory = $location->name;
                }

            }

            $data['pending_count'] = Prescription::where('prescriptions.status','pending')
                ->with('products')
                ->with('images')
                ->join('prescription_details','prescription_details.prescription_id','=','prescriptions.prescription_id')
                ->join('products','products.product_id','=','prescription_details.product_id')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->join('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('products.name','like','%'.$request->search_text.'%')
                ->groupBy('prescriptions.prescription_id')
                ->get();
        }
        else{
            $data['prescriptions'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                ->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->orderBy('prescription_id','desc')
                ->paginate(50);
            foreach($data['prescriptions'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions'][$key]->territory = $location->name;
                }

            }

            $data['prescriptions_accept'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                ->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->orderBy('prescription_id','desc')
                ->paginate(50);
            foreach($data['prescriptions_accept'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions_accept'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions_accept'][$key]->territory = $location->name;
                }

            }

            $data['prescriptions_pending'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                ->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('prescriptions.status','pending')
                ->orderBy('prescription_id','desc')
                ->paginate(50);
            foreach($data['prescriptions_pending'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions_pending'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions_pending'][$key]->territory = $location->name;
                }

            }

            $data['prescriptions_reject'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','users.hr_port','users.role_id','users.location_id','doctors.name as doctor_name','territories.name as territory','classes.class_name')
                ->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->leftJoin('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->where('prescriptions.status','rejected')
                ->orderBy('prescription_id','desc')
                ->paginate(50);
            foreach($data['prescriptions_reject'] as $key=>$prescription){
                if($prescription->role_id==4){ // If user AM
                    $location = Area::where('area_id',$prescription->location_id)->first();
                    $data['prescriptions_reject'][$key]->territory = $location->code;
                }
                else{ // If user MPO
                    $location = Territory::where('territory_id',$prescription->location_id)->first();
                    $data['prescriptions_reject'][$key]->territory = $location->name;
                }

            }

            $data['pending_count'] = Prescription::where('prescriptions.status','pending')
                ->with('products')
                ->with('images')
                ->join('users','users.id','=','prescriptions.user_id')
                ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
                ->join('classes','classes.class_id','=','doctors.class_id')
                ->join('territories','territories.territory_id','=','users.location_id')
                ->whereIn('prescriptions.user_id',$mpos)
                ->get();
        }

        $data['mpos'] = User::select('users.*','territories.name as territory_name')
            ->whereIn('id',$mpos)
            ->where('users.status','active')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->get();

        Session::put('start_date','');
        Session::put('end_date','');
        return view('report.prescription',$data);
    }

    public function filterPrescription(Request $request)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $data['page'] = 'Prescription';
        Session::put('search_string','');

        $my_mpos = Utility::getMpos(Session::get('role_id'),Session::get('id'));
        $data['mpos'] = User::select('users.*','territories.name as territory_name')
            ->whereIn('id',$my_mpos)
            ->where('users.status','active')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->get();
        
        $raw_where = '';
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        if($request->start_date !='' && $request->end_date !=''){
            $raw_where = "prescriptions.created_at>='".$start_date."' AND prescriptions.created_at<='".$end_date."'";
        }
        if($request->start_date !='' && $request->end_date ==''){
            $raw_where = "prescriptions.created_at>='".$start_date."'";
        }
        if($request->start_date =='' && $request->end_date !=''){
            $raw_where = "prescriptions.created_at<='".$end_date."'";
        }

        $data['prescriptions'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->join('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereRaw($raw_where)
            ->paginate(50);
        
        $data['prescriptions_accept'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->join('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereRaw($raw_where)
            ->where('prescriptions.status','accepted')
            ->paginate(50);
        
        $data['prescriptions_pending'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->leftJoin('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->leftJoin('classes','classes.class_id','=','doctors.class_id')
            ->leftJoin('territories','territories.territory_id','=','users.location_id')
            ->whereRaw($raw_where)
            ->where('prescriptions.status','pending')
            ->paginate(50);
        
        $data['prescriptions_reject'] = Prescription::select('prescriptions.*','users.first_name','users.last_name','doctors.name as doctor_name','territories.name as territory','classes.class_name')
            ->with('products')
            ->with('images')
            ->join('users','users.id','=','prescriptions.user_id')
            ->join('doctors','doctors.doctor_id','=','prescriptions.doctor_id')
            ->join('classes','classes.class_id','=','doctors.class_id')
            ->join('territories','territories.territory_id','=','users.location_id')
            ->whereRaw($raw_where)
            ->where('prescriptions.status','rejected')
            ->paginate(50);
        
        $data['pending_count'] = Prescription::where('status','pending')
            ->whereRaw($raw_where)
            ->get();

        Session::put('start_date',$request->start_date);
        Session::put('end_date',$request->end_date);

        return view('report.prescription',$data);
    }

    public function getImages(Request $request){
        $images = PrescriptionImage::where('prescription_id',$request->prescription_id)->get();
        $prescription_images = array();
        foreach($images as $image){
            $p_image['image_id'] = $image->prescription_image_id;
            $p_image['image_path'] = $image->image_path;

            if($image->location !=''){
                $p_image['location'] = $image->location;
            }
            else if($image->latitude=='' || $image->longitude==''){
                $p_image['location'] = '';
            }
            else{
                $location = $this->getGeoLocation($image->latitude,$image->longitude);
                $p_image['location'] = $location;
                $updateImage = PrescriptionImage::where('prescription_image_id',$image->prescription_image_id)->first();
                $updateImage->location = $location;
                $updateImage->save();
            }
            array_push($prescription_images,$p_image);
        }
        return ['status'=>200,'images'=>$prescription_images];
    }

    public function changeStatus(Request $request){
        $prescription = Prescription::where('prescription_id',$request->prescription_id)->first();
        $prescription->status = $request->status;
        $prescription->reject_reason = $request->reject_reason;
        $prescription->save();

        $message = 'Prescription '.$request->status.' successfully';

        return ['status'=>200,'reason'=>$message];
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
}
