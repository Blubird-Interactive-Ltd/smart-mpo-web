<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\UserRole;
use App\models\User;
use App\models\UserLocationMaping;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;
use App\Utility;
use App\models\Division;
use App\models\Zone;
use App\models\Region;
use App\models\Area;
use App\models\Territory;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     *Display a listing of the User.
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),29)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';

        $data['roles'] = UserRole::all();
        $data['users'] = User::leftJoin('roles','users.role_id','=','roles.role_id')
            ->where('users.status','!=','deleted')->orderBy('users.id','DESC')->get();

        $data['amList'] = User::where('status','active')->where('role_id',4)->get();
        $data['rsmList'] = User::where('status','active')->where('role_id',3)->get();
        $data['zsmList'] = User::where('status','active')->where('role_id',2)->get();
        $data['smList'] = User::where('status','active')->where('role_id',1)->get();
        $data['divisions'] = Division::where('status','Active')->orderBy('division_id','DESC')->get();
        $data['zone'] = Zone::where('status','Active')->orderBy('zone_id','DESC')->get();
        $data['regions'] = Region::where('status','Active')->orderBy('region_id','DESC')->get();
        $data['areas'] = Area::where('status','Active')->orderBy('area_id','DESC')->get();
        $data['territories'] = Territory::where('status','Active')->orderBy('territory_id','DESC')->get();
        return view('user.setup_user',$data);
    }

    /**
     * Show the form for creating a new User.
     */
    public function create()
    {



    }//

    /**
     * Store a newly user resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            //User store serversite validation
            // $input = Input::all();
            // $rules = [
            //     'email' => 'required',
            //     'parent_id'=>'required',
            //     'territory_id'=>'required',
            //     'first_name'=>'required',
            //     'last_name'=>'required',
            //     'hr_port'=>'required',
            //     'account_port'=>'required',
            //     'home_contact'=>'required',
            //     'personal_contact'=>'required',
            //     'work_contact'=>'required',
            //     'active_imei'=>'required',
            //     'user_id'=>'required',
            //     'password'=>'required',
            // ];
            // $messages = [
            //     'parent_id.required' => 'The AM field is required.',
            //     'territory_id.required' => 'The territory field is required.',
            //     'first_name.required' => 'The first name field is required.',
            //     'last_name.required' => 'The last name field is required.',
            //     'hr_port.required' => 'The HR port field is required.',
            //     'account_port.required' => 'The account port field is required.',
            // ];
            // $validator = Validator::make($input, $rules, $messages);
            // if ($validator->fails()) {
            //     return redirect()->back()
            //                 ->withErrors($validator)
            //                 ->withInput();
            // }

            //User input sanitization

            $duplicate_user_id = User::where('user_id',$request->user_id)->first();
            if(!empty($duplicate_user_id)){
                return ['status'=>401, 'reason'=>'Duplicate user id'];
            }
            $duplicate_imei = User::where('active_imei',$request->active_imei)->first();
            if(!empty($duplicate_imei)){
                return ['status'=>401, 'reason'=>'Duplicate imei'];
            }

            if($request->user_role != 1){
                $parent_id = Utility::sanitize_number($request->parent_id);
            }else{$parent_id =0; }

            $user_role = Utility::sanitize_number($request->user_role);
            $division_id = Utility::sanitize_number($request->division_id);
            $zone_id = Utility::sanitize_number($request->zone_id);
            $region_id = Utility::sanitize_number($request->region_id);
            $area_id = Utility::sanitize_number($request->area_id);
            $territory_id = Utility::sanitize_number($request->territory_id);
            $email = Utility::sanitize_email($request->email);
            $first_name = Utility::sanitize_string($request->first_name);
            $last_name = Utility::sanitize_string($request->last_name);
            $hr_port = $request->hr_port;
            $account_port = $request->account_port;
            $home_contact = Utility::sanitize_number($request->home_contact);
            $personal_contact = Utility::sanitize_number($request->personal_contact);
            $work_contact = Utility::sanitize_number($request->work_contact);
            $imei = Utility::sanitize_string($request->active_imei);
            $user_id = $request->user_id;
            $password = bcrypt($request->password);
            $app_password = MD5($request->password);
            $view_password = Utility::encrypt_string($request->password);

            //store to user table
            $user = new User;
            $user->parent_id = $parent_id;
            if($user_role==1){
                $user->location_id = $division_id;
            }
            else if($user_role==2){
                $user->location_id = $zone_id;
            }
            else if($user_role==3){
                $user->location_id = $region_id;
            }
            else if($user_role==4){
                $user->location_id = $area_id;
            }
            else if($user_role==5){
                $user->location_id = $territory_id;
            }

            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->user_id = $user_id;
            $user->email = $email;
            $user->active_imei = $imei;
            $user->password = $password;
            $user->app_password = $app_password;
            $user->is_view_password = $view_password;
            $user->hr_port = $hr_port;
            $user->account_port = $account_port;
            $user->home_contact = $home_contact;
            $user->personal_contact = $personal_contact;
            $user->work_contact = $work_contact;
            $user->work_contact = $work_contact;
            $user->role_id = $user_role;
            $result = $user->save();

            // Add new maping.
            $location_maping = NEW UserLocationMaping();
            $location_maping->user_id = $user->id;
            $location_maping->division_id = $division_id;
            $location_maping->zone_id = $zone_id;
            $location_maping->region_id = $region_id;
            $location_maping->area_id = $area_id;
            $location_maping->territory_id = $territory_id;
            $location_maping->start_date = date('Y-m-d');
            $location_maping->save();

            if($result){
                Session::flash('success','Successfully saved');
                return ['status'=>200, 'reason'=>'Successfully saved!!'];
            }

        }
        catch(\Exception $e){
            DB::rollback();
            return ['status'=>401, 'reason'=>$e->getMessage()];
        }


    }// End User Store Method Section

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
    public function edit(Request $request)
    {
        $data['status'] = 200;
        $data['users'] = User::select('users.*')->where('id',$request->id)->first();
        $locations = UserLocationMaping::where('user_id',$request->id)
            ->where('end_date',null)
            ->first();
        if(!empty($locations)){
            $data['users']->division_id = $locations->division_id;
            $data['users']->zone_id = $locations->zone_id;
            $data['users']->region_id = $locations->region_id;
            $data['users']->area_id = $locations->area_id;
            $data['users']->territory_id = $locations->territory_id;
        }
        else{
            $data['users']->division_id = '';
            $data['users']->zone_id = '';
            $data['users']->region_id = '';
            $data['users']->area_id = '';
            $data['users']->territory_id = '';
        }

        return $data;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            DB::beginTransaction();


            $duplicate_user_id = User::where('user_id',$request->user_id)->first();
            if(!empty($duplicate_user_id)){
                if($duplicate_user_id->id !=$request->uid){
                    return ['status'=>401, 'reason'=>'Duplicate user id'];
                }
            }
            $duplicate_imei = User::where('active_imei',$request->active_imei)->first();
            if(!empty($duplicate_imei)){
                if($duplicate_imei->id !=$request->uid) {
                    return ['status' => 401, 'reason' => 'Duplicate imei'];
                }
            }

            //User input sanitization
            if($request->user_role != 1){
                $parent_id = Utility::sanitize_number($request->parent_id);
            }else{
                $parent_id =0;
            }

            $user_role = Utility::sanitize_number($request->user_role);
            $division_id = Utility::sanitize_number($request->division_id);
            $zone_id = Utility::sanitize_number($request->zone_id);
            $region_id = Utility::sanitize_number($request->region_id);
            $area_id = Utility::sanitize_number($request->area_id);
            $territory_id = Utility::sanitize_number($request->territory_id);
            $email = Utility::sanitize_email($request->email);
            $first_name = Utility::sanitize_string($request->first_name);
            $last_name = Utility::sanitize_string($request->last_name);
            $hr_port = $request->hr_port;
            $account_port = $request->account_port;
            $home_contact = Utility::sanitize_number($request->home_contact);
            $personal_contact = Utility::sanitize_number($request->personal_contact);
            $work_contact = Utility::sanitize_number($request->work_contact);
            $imei = Utility::sanitize_string($request->active_imei);
            $user_id = $request->user_id;

            //store to user table
            $user =  User::find($request->uid);
            $user->parent_id = $parent_id;

            if($user_role==1){
                $user->location_id = $division_id;
            }
            else if($user_role==2){
                $user->location_id = $zone_id;
            }
            else if($user_role==3){
                $user->location_id = $region_id;
            }
            else if($user_role==4){
                $user->location_id = $area_id;
            }
            else if($user_role==5){
                $user->location_id = $territory_id;
            }
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->user_id = $user_id;
            $user->email = $email;
            $user->active_imei = $imei;
            $user->hr_port = $hr_port;
            $user->account_port = $account_port;
            $user->home_contact = $home_contact;
            $user->personal_contact = $personal_contact;
            $user->work_contact = $work_contact;
            $user->work_contact = $work_contact;
            $user->role_id = $user_role;
            $result = $user->save();

            $old_maping = UserLocationMaping::where('user_id',$request->uid)->where('end_date',null)->first();
            if(!empty($old_maping)){
                $old_maping->end_date = date('Y-m-d',strtotime("-1 days"));
                $old_maping->save();
            }

            // Add new maping.
            $location_maping = NEW UserLocationMaping();
            $location_maping->user_id = $request->uid;
            $location_maping->division_id = $division_id;
            $location_maping->zone_id = $zone_id;
            $location_maping->region_id = $region_id;
            $location_maping->area_id = $area_id;
            $location_maping->territory_id = $territory_id;
            $location_maping->start_date = date('Y-m-d');
            $location_maping->save();

            if($result){
                Session::flash('success','Operation success');
                return ['status'=>200, 'reason'=>'Operation success!!'];
            }

        }
        catch(\Exception $e){
            DB::rollback();
            return ['status'=>302, 'reason'=>$e->getMessage()];
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            DB::beginTransaction();

            $result = User::find($request->id);
            $result->status = 'deleted';
            if($result->save()){
                return ['status'=>200,'reason'=>'Operation Success !'];
            }else{
                return ['status'=>401,'reason'=>'Operation faild !!'];
            }

        }catch(\Exception $e){
            DB::rollback();
            return ['status'=>302, 'reason'=>$e->getMessage()];

        }
    }
    /**
     * Change user status.
     */
    public function changeStatus(Request $request)
    {
        try{
            DB::beginTransaction();

            $result = User::find($request->id);
            $result->status = $request->status;
            if($request->status == 'active'){
                $message = 'User activated successfully';
            }else{
                $message = 'User deactivated successfully';
            }
            if($result->save()){
                return ['status'=>200,'reason'=>$message];
            }else{
                return ['status'=>401,'reason'=>'Operation faild !!'];
            }

        }
        catch(\Exception $e){
            DB::rollback();
            return ['status'=>302, 'reason'=>$e->getMessage()];

        }
    }

    /**
     * Lock the specified resource from storage.
     */
    public function lock(Request $request)
    {
        try{
            DB::beginTransaction();

            $result = User::find($request->id);

            if($request->flag == 'unlock'){
                $result->is_locked = 0;
                $message = 'User unlocked successfully';
            }else{
                $result->is_locked = 1;
                $message = 'User locked successfully';
            }
            if($result->save()){
                return ['status'=>200,'reason'=>$message];
            }else{
                return ['status'=>401,'reason'=>'Operation faild !!'];
            }

        }catch(\Exception $e){
            DB::rollback();
            return ['status'=>302, 'reason'=>$e->getMessage()];

        }
    }

    /**
     * User profile view.
    */
    public function profile()
    {
        if(!Auth::check()){
            return redirect('login');
        }

        $data['page'] = 'Profile';
        
    $data['users'] = User::select('users.*','roles.name as role','location_type.type as locType')
        ->leftJoin('roles','users.role_id','=','roles.role_id')
        ->leftJoin('location_type','users.location_type_id','=','location_type.location_type_id')
        ->where('users.id',Auth::user()->id)
        ->first();
        
    $parent = User::select('users.first_name','last_name','roles.name as role')
        ->leftJoin('roles','users.role_id','=','roles.role_id')
        ->where('users.id',$data['users']->parent_id)
        ->first();

        $data['zone'] = Zone::orderBy('zone_id','DESC')->get();
        $data['regions'] = Region::orderBy('region_id','DESC')->get();
        $data['areas'] = Area::orderBy('area_id','DESC')->get();
        $data['territories'] = Territory::orderBy('territory_id','DESC')->get();

    if($data['users']->location_type_id == 1){
        $locName = Division::select('division_name as location')->where('division_id',$data['users']->location_id)->first();
    }elseif ($data['users']->location_type_id == 2) {
        $locName = Zone::select('zone_name as location')->where('zone_id',$data['users']->location_id)->first();
    }elseif ($data['users']->location_type_id == 3) {
        $locName = Region::select('region_name as location')->where('region_id',$data['users']->location_id)->first();
    }elseif ($data['users']->location_type_id == 4) {
        $locName = Area::select('area_name as location')->where('area_id',$data['users']->location_id)->first();
    }elseif ($data['users']->location_type_id == 5) {
        $locName = Territory::select('name as location')->where('territory_id',$data['users']->location_id)->first();
    }else{ $locName = [];}

    $data['users']->userParent = $parent;
    if(!empty($locName)){ $data['users']->location = $locName->location; }
    
        
        return view('user.profile',$data);
    }     


}// UserController End Here-------------
