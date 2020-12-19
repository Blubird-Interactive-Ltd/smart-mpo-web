<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\DoctorDcr;
use App\Models\DoctorDcrProduct;
use App\Models\DoctorDcrGift;
use App\Models\DoctorDcrVisitedTeam;
use App\Models\DoctorDcrSample;
use App\Models\DoctorDcrPpm;
use App\Models\Product;
use App\Common;
use DB;

/*
 * 1. Create Doctor DCR
 * url: http://satsai.com/dcr/doctor_dcr/create
 * parameters: {token,oauth_token,data}
 * data = array(doctor_id,user_id,remark,time,latitude,longitude,gift_name,gift_quantity,ppm_id,ppm_quantity,visited_with=[1,2.3],products=[{"product_id":2}],samples=[{"product_id":"1","quantity:10"},{"product_id":"2",,"quantity:20"}])
 * *
 * 2. Update Doctor DCR
 * url: http://satsai.com/dcr/doctor_dcr/update
 * parameters: {token,data}
 * data = array(oauth_token,doctor_dcr_id,doctor_id,user_id,remark,time,latitude,longitude,gift_name,gift_quantity,ppm_id,ppm_quantity,visited_with=[1,2.3],products=[{"product_id":2}],samples=[{"product_id":"1","quantity:10"},{"product_id":"2",,"quantity:20"}])
 *
 * */

class DoctorDcrController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        $dcrData = json_decode($request->data,true);
        $dcr_products = $dcrData['products'];
        $visited_team = $dcrData['visited_team'];
        $dcr_samples = $dcrData['samples'];

        /*####################### Validation area ends ###########################*/
        if($request->token !=Common::TOKEN_DOCTOR_DCR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($dcrData['doctor_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Doctor ID required']);
        }

        if($dcrData['user_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }
        if($dcrData['time'] == ''){
            return json_encode(['status'=>401,'reason'=>'Time required']);
        }
        if(count($dcr_products) == 0){
            return json_encode(['status'=>401,'reason'=>'Product required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        /*Check for active doctor*/
        $doctor = Doctor::where('doctor_id',$dcrData['doctor_id'])->first();
        if($doctor->status !='active'){
            return json_encode(['status'=>403,'reason'=>'Doctor '.$doctor->name.'is not active','type'=>'doctor','id'=>$doctor->doctor_id]);
        }

        /*Check for active product*/
        foreach($dcr_products as $product){
            $pr = Product::where('product_id',$product['product_id'])->first();
            if($pr->status !='active'){
                return json_encode(['status'=>403,'reason'=>'Medicine '.$pr->name.'is not active','type'=>'product','id'=>$pr->product_id]);
            }
        }
        /*Check for active product*/

        /*Check for active sample product*/
        foreach($dcr_samples as $sample){
            $pr = Product::where('product_id',$sample['product_id'])->first();
            if($pr->status !='active'){
                return json_encode(['status'=>401,'reason'=>'Sample medicine'.$pr->name.'is not active']);
            }
        }
        /*Check for active sample product*/
        /*####################### Validation area ends ###########################*/

        $dcr = NEW DoctorDcr();
        $dcr->doctor_id = $dcrData['doctor_id'];
        $dcr->user_id = $dcrData['user_id'];
        $dcr->remark = $dcrData['remark'];
        $dcr->time = $dcrData['time'];
        if(isset($dcrData['latitude'])){
            $dcr->latitude = $dcrData['latitude'];
        }
        if(isset($dcrData['longitude'])){
            $dcr->longitude = $dcrData['longitude'];
        }
        $dcr->reject_reason = '.';
        $dcr->updated_at = date('Y-m-d');
        $dcr->save();

        // Add dcr gift
        $dcrGift = NEW DoctorDcrGift();
        $dcrGift->doctor_dcr_id = $dcr->doctor_dcr_id;
        $dcrGift->gift_name = $dcrData['gift_name'];
        $dcrGift->quantity = $dcrData['gift_quantity'];
        $dcrGift->save();

        // Add dcr ppm
        $dcrPpm = NEW DoctorDcrPpm();
        $dcrPpm->doctor_dcr_id = $dcr->doctor_dcr_id;
        $dcrPpm->ppm_id = $dcrData['ppm_id'];
        $dcrPpm->quantity = $dcrData['ppm_quantity'];
        $dcrPpm->save();

        // Adding dcr visited team
        foreach($visited_team as $team){
            $visited = NEW DoctorDcrVisitedTeam();
            $visited->doctor_dcr_id = $dcr->doctor_dcr_id;
            $visited->team_member_id = $team;
            $visited->save();
        }

        // Adding dcr products
        foreach($dcr_products as $product){
            $dcr_product = NEW DoctorDcrProduct();
            $dcr_product->doctor_dcr_id = $dcr->doctor_dcr_id;
            $dcr_product->product_id = $product['product_id'];
            $dcr_product->save();
        }

        // Adding dcr samples
        foreach($dcr_samples as $sample){
            $dcr_sample = NEW DoctorDcrSample();
            $dcr_sample->doctor_dcr_id = $dcr->doctor_dcr_id;
            $dcr_sample->product_id = $sample['product_id'];
            $dcr_sample->quantity = $sample['quantity'];
            $dcr_sample->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successful','doctor_dcr_id'=>$dcr->doctor_dcr_id]);

    }

    public function update(Request $request){
        //$dcrData = gzuncompress($request->data);
        $dcrData = json_decode($request->data,true);
        $visited_team = $dcrData['visited_team'];
        $dcr_products = $dcrData['products'];
        $dcr_samples = $dcrData['samples'];

        /*####################### Validation area ends ###########################*/

        if($request->token !=Common::TOKEN_DOCTOR_DCR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($dcrData['doctor_dcr_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Doctor dcr ID required']);
        }
        if($dcrData['doctor_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Doctor ID required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        /*Check for active doctor*/
        $doctor = Doctor::where('doctor_id',$dcrData['doctor_id'])->first();
        if($doctor->status !='active'){
            return json_encode(['status'=>403,'reason'=>'Doctor'.$doctor->name.'is not active','type'=>'doctor','id'=>$doctor->doctor_id]);
        }

        /*Check for active product*/
        foreach($dcr_products as $product){
            $pr = Product::where('product_id',$product['product_id'])->first();
            if($pr->status !='active'){
                return json_encode(['status'=>403,'reason'=>'Medicine'.$pr->name.'is not active','type'=>'product','id'=>$pr->product_id]);
            }
        }
        /*Check for active product*/

        /*Check for active sample product*/
        foreach($dcr_samples as $sample){
            $pr = Product::where('product_id',$sample['product_id'])->first();
            if($pr->status !='active'){
                return json_encode(['status'=>401,'reason'=>'Sample medicine'.$pr->name.'is not active']);
            }
        }
        /*Check for active sample product*/
        /*####################### Validation area ends ###########################*/


        $dcr = DoctorDcr::where('doctor_dcr_id',$dcrData['doctor_dcr_id'])->first();
        $dcr->doctor_id = $dcrData['doctor_id'];
        $dcr->user_id = $dcrData['user_id'];
        $dcr->remark = $dcrData['remark'];
        $dcr->time = $dcrData['time'];
        if(isset($dcrData['latitude'])){
            $dcr->latitude = $dcrData['latitude'];
        }
        if(isset($dcrData['longitude'])){
            $dcr->longitude = $dcrData['longitude'];
        }
        $dcr->save();

        // Add dcr gift
        DoctorDcrGift::where('doctor_dcr_id',$dcrData['doctor_dcr_id'])->delete();
        $dcrGift = NEW DoctorDcrGift();
        $dcrGift->doctor_dcr_id = $dcrData['doctor_dcr_id'];
        $dcrGift->gift_name = $dcrData['gift_name'];
        $dcrGift->quantity = $dcrData['gift_quantity'];
        $dcrGift->save();

        // Add dcr ppm
        DoctorDcrPpm::where('doctor_dcr_id',$dcrData['doctor_dcr_id'])->delete();
        $dcrPpm = NEW DoctorDcrPpm();
        $dcrPpm->doctor_dcr_id = $dcrData['doctor_dcr_id'];
        $dcrPpm->ppm_id = $dcrData['ppm_id'];
        $dcrPpm->quantity = $dcrData['ppm_quantity'];
        $dcrPpm->save();

        // Adding dcr visited team
        DoctorDcrVisitedTeam::where('doctor_dcr_id',$dcrData['doctor_dcr_id'])->delete();
        foreach($visited_team as $team){
            $visited = NEW DoctorDcrVisitedTeam();
            $visited->doctor_dcr_id = $dcrData['doctor_dcr_id'];
            $visited->team_member_id = $team;
            $visited->save();
        }

        // Adding doctor dcr products
        // First delete dcr products doctor dcr
        DoctorDcrProduct::where('doctor_dcr_id',$dcrData['doctor_dcr_id'])->delete();
        // Now add new home address
        //$dcr_products = json_decode($dcr['products'],true);
        foreach($dcr_products as $product){
            $dcr_product = NEW DoctorDcrProduct();
            $dcr_product->doctor_dcr_id = $dcrData['doctor_dcr_id'];
            $dcr_product->product_id = $product['product_id'];
            $dcr_product->save();
        }

        // Adding dcr samples
        DoctorDcrSample::where('doctor_dcr_id',$dcrData['doctor_dcr_id'])->delete();
        foreach($dcr_samples as $sample){
            $dcr_sample = NEW DoctorDcrSample();
            $dcr_sample->doctor_dcr_id = $dcrData['doctor_dcr_id'];
            $dcr_sample->product_id = $sample['product_id'];
            $dcr_sample->quantity = $sample['quantity'];
            $dcr_sample->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successful']);


    }
}
