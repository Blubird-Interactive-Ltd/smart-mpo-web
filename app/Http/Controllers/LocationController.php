<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Division;
use App\models\Zone;
use App\models\Region;
use App\models\Area;
use App\models\Territory;
use Session;
use DB;
use Auth;
use App\Utility;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),35)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        $data['thanas'] = DB::table('address_thanas')->orderBy('thana_name','ASC')->get();
        $data['divisions'] = Division::orderBy('division_id','DESC')->get();
        $data['zone'] = Zone::select('zones.*','divisions.name as division_name')
            ->join('divisions','divisions.division_id','=','zones.division_id')
            ->orderBy('zones.zone_id','DESC')->get();
        $data['regions'] = Region::select('regions.*','zones.zone_name')
            ->join('zones','zones.zone_id','=','regions.zone_id')
            ->orderBy('regions.region_id','DESC')->get();
        $data['areas'] = Area::select('areas.*','regions.region_name')
            ->join('regions','regions.region_id','=','areas.region_id')
            ->orderBy('areas.area_id','DESC')->get();
        $data['territories'] = DB::table('territories')->select('territories.*','areas.area_name','address_thanas.thana_name')
            ->join('areas','areas.area_id','=','territories.area_id')
            ->leftJoin('address_thanas','address_thanas.thana_id','=','territories.thana_id')
            ->orderBy('territories.territory_id','DESC')->get();
        
        return view('location.location_setup',$data);
        //echo "<pre>"; print_r($data['territories']); echo "<pre>";
    }

    /**
     * Division store from here
     */
    public function divisionStore(Request $request)
    {
        try{
            DB::beginTransaction();
            $name = Utility::sanitize_string($request->name);
            $obj = new Division;
            $obj->name = $name;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    }

    /**
     * Division store from here
     */
    public function divisionUpdate(Request $request)
    {
        try{
            DB::beginTransaction();
            $name = Utility::sanitize_string($request->name);
            
            $obj = Division::find($request->division_id);
            $obj->name = $name;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    }

    /**
     * Zone store from here
    */
    public function zoneStore(Request $request)
    {
        try{
            DB::beginTransaction();
            $division_id = Utility::sanitize_number($request->state);
            $name = Utility::sanitize_string($request->name);

            $obj = new Zone;
            $obj->zone_name = $name;
            $obj->division_id = $division_id;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','zone');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    } 

        /**
     * Zone store from here
    */
    public function zoneUpdate(Request $request)
    {
        try{
            DB::beginTransaction();
            $division_id = Utility::sanitize_number($request->state);
            $name = Utility::sanitize_string($request->name);

            $obj =  Zone::find($request->zone_id);
            $obj->zone_name = $name;
            $obj->division_id = $division_id;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','zone');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    } 

    /**
     * Region store from here
    */
    public function regionStore(Request $request)
    {
        try{
            DB::beginTransaction();
            $zone = Utility::sanitize_number($request->zone);
            $name = Utility::sanitize_string($request->name);

            $obj = new Region;
            $obj->region_name = $name;
            $obj->zone_id = $zone;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','region');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    }  
    /**
     * Region update from here
    */
    public function regionUpdate(Request $request)
    {
        try{
            DB::beginTransaction();
            $zone = Utility::sanitize_number($request->zone);
            $name = Utility::sanitize_string($request->name);

            $obj = Region::find($request->region_id);
            $obj->region_name = $name;
            $obj->zone_id = $zone;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','region');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    } 
    /**
     * Area store from here
    */
    public function areaStore(Request $request)
    {
        try{
            DB::beginTransaction();
            $region = Utility::sanitize_number($request->region);
            $name = Utility::sanitize_string($request->name);

            $obj = new Area;
            $obj->area_name = $name;
            $obj->region_id = $region;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','area');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    } 

        /**
     * Area store from here
    */
    public function areaUpdate(Request $request)
    {
        try{
            DB::beginTransaction();
            $region = Utility::sanitize_number($request->region);
            $name = Utility::sanitize_string($request->name);

            $obj = Area::find($request->area_id);
            $obj->area_name = $name;
            $obj->region_id = $region;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','area');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    } 


    /**
     * Area store from here
    */
    public function territoryStore(Request $request)
    {
        try{
            DB::beginTransaction();
            $area = Utility::sanitize_number($request->area);
            $thana = Utility::sanitize_number($request->thana);
            $name = Utility::sanitize_string($request->name);

            $obj = new Territory;
            $obj->name = $name;
            $obj->area_id = $area;
            $obj->thana_id = $thana;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','territory');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    } 

    /**
     * Area store from here
    */
    public function territoryUpdate(Request $request)
    {
        try{
            DB::beginTransaction();
            $area = Utility::sanitize_number($request->area);
            $thana = Utility::sanitize_number($request->thana);
            $name = Utility::sanitize_string($request->name);

            $obj = Territory::find($request->territory_id);
            $obj->name = $name;
            $obj->area_id = $area;
            $obj->thana_id = $thana;
            $result = $obj->save();
            if($result){
                Session::flash('success','Successfully saved');
                Session::flash('key','territory');
                return ['status'=>200,'reason'=>'Successfully saved'];
            } 

        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    }  

    /**
     * Area store from here
    */
    public function getEditData(Request $request)
    {
        try{
            DB::beginTransaction();

            $table = $request->table;
            $id = $request->id;
            if($table == 'division'){
                $data = Division::where('division_id',$id)->first();
            }
            if($table == 'zone'){
                $data = Zone::where('zone_id',$id)->first();
            }
            if($table == 'region'){
                $data = Region::where('region_id',$id)->first();
            }
            if($table == 'area'){
                $data = Area::where('area_id',$id)->first();
            }
            if($table == 'territory'){
                $data = Territory::where('territory_id',$id)->first();
            }
            return ['status'=>200,'all'=>$data];
        }catch(\Exception $e){ 
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }          
    }


    /**
     * Delete function from here
    */
    public function changeLocationStatus(Request $request)
    {
        //try{
            DB::beginTransaction();

            $table = $request->table;
            $id = $request->id;
            if($table == 'division'){
                $data = Division::where('division_id',$id)->first();
                $data->status = $request->status;
                $data->save();
            }
            if($table == 'zone'){
                $data = Zone::where('zone_id',$id)->first();
                $data->status = $request->status;
                $data->save();
            }
            if($table == 'region'){
                $data = Region::where('region_id',$id)->first();
                $data->status = $request->status;
                $data->save();
            }
            if($table == 'area'){
                $data = Area::where('area_id',$id)->first();
                $data->status = $request->status;
                $data->save();
            }
            if($table == 'territory'){
                $data = Territory::where('territory_id',$id)->first();
                $data->status = $request->status;
                $data->save();
            }
            if ($data) {
                $message = '';
                if($request->status=='Active'){
                    $message = $table." activated successfully";
                }
                else{
                    $message = $table." deactivated successfully";
                }
               return ['status'=>200,'reason'=>$message];
            }
            
       /* }catch(\Exception $e){
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>401,'reason'=>'System problem'];
        }    */
    }


    /**
     * Delete function from here
    */
    public function dataDelete(Request $request)
    {
        try{
            DB::beginTransaction();

            $table = $request->table;
            $id = $request->id;
            if($table == 'division'){
                $data = Division::where('division_id',$id)->delete();
            }
            if($table == 'zone'){
                $data = Zone::where('zone_id',$id)->delete();
            }
            if($table == 'region'){
                $data = Region::where('region_id',$id)->delete();
            }
            if($table == 'area'){
                $data = Area::where('area_id',$id)->delete();
            }
            if($table == 'territory'){
                $data = Territory::where('territory_id',$id)->delete();
            }
            if ($data) {
               return ['status'=>200,'reason'=>'Successfully saved'];
            }

        }catch(\Exception $e){
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return ['status'=>200,'reason'=>'System problem'];
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDistrictByDivision(Request $request){
        $districts = DB::table('address_districts')->where('division_id', $request->division_id)->get();
        $options = '<option value="">Select District</option>';
        foreach($districts as $district){
            $options .='<option value="'.$district->district_id.'">'.$district->district_name.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }
    public function getThanaByDistrict(Request $request){
        $thanas= DB::table('address_thanas')->where('district_id', $request->district_id)->get();
        $options = '<option value="">Select Thana/City</option>';
        foreach($thanas as $thana){
            $options .='<option value="'.$thana->thana_id.'">'.$thana->thana_name.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }
    public function getZipByThana(Request $request){
        $zips = DB::table('address_zips')->where('thana_id', $request->thana_id)->get();
        $options = '<option value="">Select Zip</option>';
        foreach($zips as $zip){
            $options .='<option value="'.$zip->zip_id.'">'.$zip->zip_code.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }

    public function getZoneByDivision(Request $request){
        $zones = DB::table('zones')->where('division_id', $request->division_id)->get();
        $options = '<option value="">Select Zone</option>';
        foreach($zones as $zone){
            $options .='<option value="'.$zone->zone_id.'">'.$zone->zone_name.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }

    public function getRegionByZone(Request $request){
        $regions = DB::table('regions')->where('zone_id', $request->zone_id)->get();
        $options = '<option value="">Select Region</option>';
        foreach($regions as $region){
            $options .='<option value="'.$region->region_id.'">'.$region->region_name.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }

    public function getAreaByRegion(Request $request){
        $areas = DB::table('areas')->where('region_id', $request->region_id)->get();
        $options = '<option value="">Select Area</option>';
        foreach($areas as $area){
            $options .='<option value="'.$area->area_id.'">'.$area->area_name.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }

    public function getTerritoryByArea(Request $request){
        $territories = DB::table('territories')->where('area_id', $request->area_id)->get();
        $options = '<option value="">Select Territory</option>';
        foreach($territories as $territory){
            $options .='<option value="'.$territory->territory_id.'">'.$territory->name.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }
}
