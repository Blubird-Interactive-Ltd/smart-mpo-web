<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PrescriptionDetails;
use App\Models\PrescriptionImage;
use App\Common;
use DB;

/*
 * 1. Create Prescription
 * url: http://202.125.76.60/v1/prescription/create
 * parameters: {token,gzcompress(data)}
 * data = array(user_id,doctor_id,oauth_token,image,products=[1,2,3])
 *
 * 2. Update Prescription
 * url: http://202.125.76.60/v1/prescription/update
 * parameters: {token,gzcompress(data)}
 * data = array(prescription_id,doctor_id,oauth_token,products=[1,2,3])
 *
 * */

class PrescriptionController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        $bodyContent = $request->getContent();

        //$data_decode = json_decode($bodyContent,true);

        //echo "<pre>"; print_r($data_decode); echo "</pre>"; exit();

        if($request->token !=Common::TOKEN_PRESCRIPTIONS){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        $prescriptionData = json_decode($request->data,true);

        if($prescriptionData['user_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }

        if($prescriptionData['doctor_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Doctor ID required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/


        $prescription = NEW Prescription();
        $prescription->user_id = $prescriptionData['user_id'];
        $prescription->doctor_id = $prescriptionData['doctor_id'];
        $prescription->created_at = date('Y-m-d h:i:s');
        //$prescription->image = $imageName;
        $prescription->save();

        if ($request->hasFile('image1')) {
            //checks if file is uploaded or not
            if ($request->file('image1')->isValid()) {
                $destinationPath = 'uploads/prescriptions';
                $extension = $request->file('image1')->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time()."_".$imageName.".".$extension;
                $filePath = $destinationPath.'/'.$fileName;
                $request->file('image1')->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->save();
            }
        }

        if ($request->hasFile('image2')) {
            //checks if file is uploaded or not
            if ($request->file('image2')->isValid()) {
                $destinationPath = 'uploads/prescriptions';
                $extension = $request->file('image2')->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time()."_".$imageName.".".$extension;
                $filePath = $destinationPath.'/'.$fileName;
                $request->file('image2')->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->save();
            }
        }

        if ($request->hasFile('image3')) {
            //checks if file is uploaded or not
            if ($request->file('image3')->isValid()) {
                $destinationPath = 'uploads/prescriptions';
                $extension = $request->file('image3')->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time()."_".$imageName.".".$extension;
                $filePath = $destinationPath.'/'.$fileName;
                $request->file('image3')->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->save();
            }
        }

        /*
         * Adding products
         */
        $products = $prescriptionData['products'];
        foreach($products as $product){
            $pDetails = NEW PrescriptionDetails();
            $pDetails->prescription_id = $prescription->prescription_id;
            $pDetails->product_id = $product;
            $pDetails->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successful','prescription_id'=>$prescription->prescription_id]);

    }

    public function update(Request $request){
        if($request->token !=Common::TOKEN_PRESCRIPTIONS){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        $prescriptionData = json_decode($request->data,true);

        if($prescriptionData['prescription_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Prescription ID required']);
        }

        if($prescriptionData['doctor_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Doctor ID required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $prescription = Prescription::where('prescription_id',$prescriptionData['prescription_id'] )->first();
        $prescription->doctor_id = $prescriptionData['doctor_id'] ;
        $prescription->save();

        if ($request->hasFile('image1')) {
            //checks if file is uploaded or not
            if ($request->file('image1')->isValid()) {
                $destinationPath = 'uploads/prescriptions';
                $extension = $request->file('image1')->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time()."_".$imageName.".".$extension;
                $filePath = $destinationPath.'/'.$fileName;
                $request->file('image1')->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->save();
            }
        }

        if ($request->hasFile('image2')) {
            //checks if file is uploaded or not
            if ($request->file('image2')->isValid()) {
                $destinationPath = 'uploads/prescriptions';
                $extension = $request->file('image2')->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time()."_".$imageName.".".$extension;
                $filePath = $destinationPath.'/'.$fileName;
                $request->file('image2')->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->save();
            }
        }

        if ($request->hasFile('image3')) {
            //checks if file is uploaded or not
            if ($request->file('image3')->isValid()) {
                $destinationPath = 'uploads/prescriptions';
                $extension = $request->file('image3')->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time()."_".$imageName.".".$extension;
                $filePath = $destinationPath.'/'.$fileName;
                $request->file('image3')->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->save();
            }
        }

        // Adding products
        // First delete products for this prescription
        PrescriptionDetails::where('prescription_id',$prescriptionData['prescription_id'])->delete();
        // Now add new products
        $products = $prescriptionData['products'];
        foreach($products as $product){
            $pDetails = NEW PrescriptionDetails();
            $pDetails->prescription_id = $prescriptionData['prescription_id'];
            $pDetails->product_id = $product;
            $pDetails->save();
        }
        return json_encode(['status'=>200,'reason'=>'Successful']);


    }
}
