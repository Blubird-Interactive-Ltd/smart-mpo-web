<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DoctorDcr;
use Illuminate\Http\Request;
use App\Models\Chemist;
use App\Models\ChemistDcr;
use App\Models\ChemistDcrProduct;
use App\Models\ChemistDcrGift;
use App\Models\ChemistDcrVisitedTeam;
use App\Models\Product;
use App\Common;
use DB;

/*
 * 1. Create Chemist DCR
 * url: http://satsai.com/dcr/v1/chemist_dcr/create
 * parameters: {token,data}
 * data = array(oauth_token,chemist_id,user_id,remark,time,gift_name,gift_quantity,order_value,collection,cash,credit,visited_team=[1,2,3],products=[{"product_id":2,"order_value":10,"collection":5},{"product_id":10}])
 * *
 * 2. Update Chemist DCR
 * url: http://satsai.com/dcr/v1/chemist_dcr/update
 * parameters: {token,gzcompress(data)}
 * data = array(oauth_token,chemist_dcr_id,chemist_id,user_id,remark,time,gift_name,gift_quantity,order_value,collection,cash,credit,visited_team=[1,2,3],products=[{"product_id":2,"order_value":10,"collection":5},{"chemist_id":2,"product_id":10,"cash":100.00,"credit":50.00}])
 *
 * */

class ChemistDcrController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        //$dcrData = gzuncompress($request->data);
        $dcrData = json_decode($request->data,true);
        $dcr_products = $dcrData['products'];
        $visited_team = $dcrData['visited_team'];

        /*####################### Validation area ###########################*/

        if($request->token !=Common::TOKEN_CHEMIST_DCR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($dcrData['chemist_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Chemist ID required']);
        }

        if($dcrData['user_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'User ID required']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        /*Check for active chemist*/
        $chemist = Chemist::where('chemist_id',$dcrData['chemist_id'])->first();
        if($chemist->status !='active'){
            return json_encode(['status'=>403,'reason'=>'Chemist'.$chemist->name.'is not active','type'=>'chemist','id'=>$chemist->chemist_id]);
        }

        /*Check for active product*/
        foreach($dcr_products as $product){
            $pr = Product::where('product_id',$product['product_id'])->first();
            if($pr->status !='active'){
                return json_encode(['status'=>403,'reason'=>'Medicine'.$pr->name.'is not active','type'=>'product','id'=>$pr->product_id]);
            }
        }
        /*Check for active product*/
        /*####################### Validation area ends ###########################*/

        $dcr = NEW ChemistDcr();
        $dcr->chemist_id = $dcrData['chemist_id'];
        $dcr->user_id = $dcrData['user_id'];
        $dcr->remark = $dcrData['remark'];
		$dcr->order_value = $dcrData['order_value'];
		$dcr->collection = $dcrData['collection'];
		$dcr->cash = $dcrData['cash'];
		$dcr->credit = $dcrData['credit'];
        $dcr->time = $dcrData['time'];
        $dcr->updated_at = date('Y-m-d');
        $dcr->save();

        //Add chemist dcr gift
        $dcrGift = NEW ChemistDcrGift();
        $dcrGift->chemist_dcr_id = $dcr->chemist_dcr_id;
        $dcrGift->gift_name = $dcrData['gift_name'];
        $dcrGift->quantity = $dcrData['gift_quantity'];
        $dcrGift->save();

        //Add visited with
        foreach($visited_team as $team){
            $visited = NEW ChemistDcrVisitedTeam();
            $visited->chemist_dcr_id = $dcr->chemist_dcr_id;
            $visited->team_member_id = $team;
            $visited->save();
        }

        // Adding dcr products
        //$dcr_products = json_decode($dcr['products'],true);
        foreach($dcr_products as $product){
            $dcr_product = NEW ChemistDcrProduct();
            $dcr_product->chemist_dcr_id = $dcr->chemist_dcr_id;
            $dcr_product->chemist_id = $dcrData['chemist_id'];
            $dcr_product->product_id = $product['product_id'];
            $dcr_product->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successful','chemist_dcr_id'=>$dcr->chemist_dcr_id]);

    }

    public function update(Request $request){
        //$dcrData = gzuncompress($request->data);
        $dcrData = json_decode($request->data,true);
        $dcr_products = $dcrData['products'];
        $visited_team = $dcrData['visited_team'];

        /*####################### Validation area ###########################*/
        if($request->token !=Common::TOKEN_CHEMIST_DCR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        if($dcrData['chemist_dcr_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Chemist dcr id required']);
        }
        if($dcrData['chemist_id'] == ''){
            return json_encode(['status'=>401,'reason'=>'Chemist ID required']);
        }
        if($dcrData['remark'] == ''){
            return json_encode(['status'=>401,'reason'=>'Remark required']);
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

        /*Check for active chemist*/
        $chemist = Chemist::where('chemist_id',$dcrData['chemist_id'])->first();
        if($chemist->status !='active'){
            return json_encode(['status'=>403,'reason'=>'Chemist'.$chemist->name.'is not active','type'=>'chemist','id'=>$chemist->chemist_id]);
        }

        /*Check for active product*/
        foreach($dcr_products as $product){
            $pr = Product::where('product_id',$product['product_id'])->first();
            if($pr->status !='active'){
                return json_encode(['status'=>403,'reason'=>'Medicine'.$pr->name.'is not active','type'=>'product','id'=>$pr->product_id]);
            }
        }
        /*Check for active product*/
        /*####################### Validation area ends ###########################*/

        $dcr = ChemistDcr::where('chemist_dcr_id',$dcrData['chemist_dcr_id'])->first();
        $dcr->chemist_id = $dcrData['chemist_id'];
        $dcr->remark = $dcrData['remark'];
		$dcr->order_value = $dcrData['order_value'];
		$dcr->collection = $dcrData['collection'];
		$dcr->cash = $dcrData['cash'];
		$dcr->credit = $dcrData['credit'];
        $dcr->time = $dcrData['time'];
        $dcr->save();

        //Add chemist dcr gift
        ChemistDcrGift::where('chemist_dcr_id',$dcrData['chemist_dcr_id'])->delete();
        $dcrGift = NEW ChemistDcrGift();
        $dcrGift->chemist_dcr_id = $dcrData['chemist_dcr_id'];
        $dcrGift->gift_name = $dcrData['gift_name'];
        $dcrGift->quantity = $dcrData['gift_quantity'];
        $dcrGift->save();

        //Add visited with
        ChemistDcrVisitedTeam::where('chemist_dcr_id',$dcrData['chemist_dcr_id'])->delete();
        foreach($visited_team as $team){
            $visited = NEW ChemistDcrVisitedTeam();
            $visited->chemist_dcr_id = $dcrData['chemist_dcr_id'];
            $visited->team_member_id = $team;
            $visited->save();
        }

        // Adding dcr products
        // First delete home address for this doctor
        ChemistDcrProduct::where('chemist_dcr_id',$dcrData['chemist_dcr_id'])->delete();
        // Now add new dcr products
        foreach($dcr_products as $product){
            $dcr_product = NEW ChemistDcrProduct();
            $dcr_product->chemist_dcr_id = $dcr->chemist_dcr_id;
            $dcr_product->chemist_id = $dcrData['chemist_id'];
            $dcr_product->product_id = $product['product_id'];
            $dcr_product->save();
        }

        return json_encode(['status'=>200,'reason'=>'Successfully saved']);


    }

    public function details(Request $request){
        if($request->token !=Common::TOKEN_CHEMIST_DCR){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $chemist = Chemist::where('chemist_id',$request->chemist_id)->first();
        return json_encode(['status'=>200,'reason'=>'','data'=>json_encode($chemist)]);
    }
}
