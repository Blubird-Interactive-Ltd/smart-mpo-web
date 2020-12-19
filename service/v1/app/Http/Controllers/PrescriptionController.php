<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\PrescriptionDetails;
use App\Models\PrescriptionImage;
use App\Common;
use DB;

/*
 * 1. Create Prescription
 * url: http://202.125.76.60/v1/prescription/create
 * parameters: {token,gzcompress(data)}
 * data = array(user_id,doctor_id,oauth_token,image1,image2,image2,"latitude":"42798","longitude":"-258974",products=[1,2,3])
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
        try {
            //echo "<pre>"; print_r($data_decode); echo "</pre>"; exit();

            if ($request->token != Common::TOKEN_PRESCRIPTIONS) {
                return json_encode(['status' => 401, 'reason' => 'Invalid token']);
            }

            $prescriptionData = json_decode($request->data, true);
            $image1 = $request->file('image1');
            $image2 = $request->file('image2');
            $image3 = $request->file('image3');
            $products = $prescriptionData['products'];
            $has_image = 0;

            if ($prescriptionData['user_id'] == '') {
                return json_encode(['status' => 401, 'reason' => 'User ID required']);
            }

            if ($prescriptionData['doctor_id'] == '') {
                return json_encode(['status' => 401, 'reason' => 'Doctor ID required']);
            }
            if (!empty($image1)) {
                $has_image = 1;
            }
            if (!empty($image2)) {
                $has_image = 1;
            }
            if (!empty($image3)) {
                $has_image = 1;
            }
            if ($has_image == 0) {
                return json_encode(['status' => 401, 'reason' => 'At least one image required']);
            }

            /*Check oauth token starts*/
            $user = User::where('active_oauth_token', $request->oauth_token)->first();
            if (empty($user)) {
                return json_encode(['status' => 401, 'reason' => 'Invalid oauth token']);
            }
            /*Check oauth token ends*/

            /*Check for active doctor*/
            $doctor = Doctor::where('doctor_id', $prescriptionData['doctor_id'])->first();
            if ($doctor->status != 'active') {
                return json_encode(['status' => 403, 'reason' => 'Doctor' . $doctor->name . 'is not active', 'type' => 'doctor', 'id' => $doctor->doctor_id]);
            }

            /*Check for active product*/
            foreach ($products as $product) {
                $pr = Product::where('product_id', $product['product_id'])->first();
                if ($pr->status != 'active') {
                    return json_encode(['status' => 403, 'reason' => 'Medicine' . $pr->name . 'is not active', 'type' => 'product', 'id' => $pr->product_id]);
                }
            }
            /*Check for active product*/


            $prescription = NEW Prescription();
            $prescription->user_id = $prescriptionData['user_id'];
            $prescription->doctor_id = $prescriptionData['doctor_id'];
            $prescription->created_at = date('Y-m-d h:i:s');
            //$prescription->image = $imageName;
            $prescription->save();

            if (!empty($image1)) {
                //checks if file is uploaded or not
                $destinationPath = 'uploads/prescriptions';
                $extension = $image1->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time() . "_" . $imageName . "." . $extension;
                $filePath = $destinationPath . '/' . $fileName;
                $image1->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->latitude = $prescriptionData['latitude'];
                $p_img->longitude = $prescriptionData['longitude'];
                $p_img->save();
            }

            if (!empty($image2)) {
                //checks if file is uploaded or not
                $destinationPath = 'uploads/prescriptions';
                $extension = $image2->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time() . "_" . $imageName . "." . $extension;
                $filePath = $destinationPath . '/' . $fileName;
                $image2->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->latitude = $prescriptionData['latitude'];
                $p_img->longitude = $prescriptionData['longitude'];
                $p_img->save();
            }

            if (!empty($image3)) {
                //checks if file is uploaded or not
                $destinationPath = 'uploads/prescriptions';
                $extension = $image3->getClientOriginalExtension();
                $imageName = str_random(60);
                $fileName = time() . "_" . $imageName . "." . $extension;
                $filePath = $destinationPath . '/' . $fileName;
                $image3->move($destinationPath, $fileName);

                $p_img = NEW PrescriptionImage();
                $p_img->prescription_id = $prescription->prescription_id;
                $p_img->image_path = $filePath;
                $p_img->latitude = $prescriptionData['latitude'];
                $p_img->longitude = $prescriptionData['longitude'];
                $p_img->save();
            }

            /*
             * Adding products
             */
            foreach ($products as $product) {
                $pDetails = NEW PrescriptionDetails();
                $pDetails->prescription_id = $prescription->prescription_id;
                $pDetails->product_id = $product['product_id'];
                $pDetails->save();
            }

            return json_encode(['status' => 200, 'reason' => 'Successful', 'prescription_id' => $prescription->prescription_id]);
        }
        catch(\Exception $e){
            return json_encode(['status' => 401, 'reason' => $e->getMessage()]);
        }

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
