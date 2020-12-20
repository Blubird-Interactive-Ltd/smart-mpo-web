<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Zone;
use App\Models\Area;
use App\Models\Location;
use App\Models\LocationMaping;
use App\Models\UserLocationMaping;
use App\Models\Login_log;
use App\Models\UserSession;
use App\Common;
use App\Utility;
use Hash;

/*
 * 1. Authenticate IMEI
 * url: http://202.125.76.60/v1/authenticate_imei
 * parameters: {token,imei}
 *
 * 2. Register
 * url: http://202.125.76.60/service/v1/register
 * parameters: {token,imei,user_id,confirm_password,passcode,confirm_passcode}
 *
 * 3. Login
 * url: http://202.125.76.60/v1/app_login
 * parameters: {token,user_id,passcode}
 *
 * 4. Logout
 * url: http://202.125.76.60/v1/app_logout
 * parameters: {token,oauth_token,user_id}
 *
 * 5. force Logout
 * url: http://202.125.76.60/v1/force_logout
 * parameters: {token,user_id}
 *
 * */

class AuthenticationController extends Controller
{
    public function index(){
        //return 'welcome';
        return bcrypt('123456');
    }

    public function authenticateImei(Request $request){
        if($request->token !=Common::TOKEN_AUTHENTICATION){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->imei == ''){
            return json_encode(['status'=>401,'reason'=>'IMEI required']);
        }
        $imei = User::where('active_imei',$request->imei)->first();
        if(empty($imei)){
            return json_encode(['status'=>401,'reason'=>'This IMEI not activated yet']);
        }
        return json_encode(['status'=>200,'reason'=>'Valid IMEI','is_registered'=>$imei->is_registered,'user_id'=>$imei->user_id]);
    }

    public function register(Request $request){
        if($request->token !=Common::TOKEN_AUTHENTICATION){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->user_id == ''){
            return json_encode(['status'=>401,'reason'=>'User id required']);
        }
        /*if($request->imei == ''){
            return json_encode(['status'=>401,'reason'=>'IMEI required']);
        }*/
        if($request->password == ''){
            return json_encode(['status'=>401,'reason'=>'password required']);
        }
        if($request->passcode == ''){
            return json_encode(['status'=>401,'reason'=>'passcode required']);
        }
        if($request->confirm_passcode == ''){
            return json_encode(['status'=>401,'reason'=>'confirm passcode required']);
        }
        if($request->passcode != $request->confirm_passcode){
            return json_encode(['status'=>401,'reason'=>'passcode doesnot match with confirm passcode']);
        }

        $user_id = base64_decode($request->user_id);
        $imei = base64_decode($request->imei);
        $password = base64_decode($request->password);
        $passcode = base64_decode($request->passcode);

        $oauth_token = $this->generateOauthToken();

        //$view_password = Utility::encrypt_string($password);
        $view_password = MD5($password);

        $user = User::where('user_id',$user_id)
            ->where('app_password', $view_password)
            ->where('active_imei', $imei)
            ->first();

        /*$passwd = Hash::make($password);
        $user = User::where('user_id',$user_id)
            ->where('password', Hash::check('password', $password))
            ->where('active_imei', $imei)
            ->first();*/

        if(empty($user)){ // No matched found
            return json_encode(['status'=>401,'reason'=>'Invalid credentials']);
        }
        else{
            $user->passcode = MD5($passcode);
            $user->is_registered = 1;
            $user->active_oauth_token = $oauth_token;
            $user->save();

            //Start. Add data on user session table
            $userSession = NEW UserSession();
            $userSession->user_id = $user->id;
            $userSession->oauth_token = $oauth_token;
            $userSession->created_at = date('Y-m-d h:i:s');
            $userSession->save();
            //End. Add data on user session table


            $locations = UserLocationMaping::where('user_id',$user->id)
                ->where('end_date',null)
                ->first();
            if(!empty($locations)){
                $territory_id = $locations->territory_id;
            }
            else{
                $territory_id = '';
            }

            return json_encode(['status'=>200,'reason'=>'Successfully Registered','user_id'=>$user->user_id,'imei'=>$imei,'oauth_token'=>$oauth_token,'territory'=>$territory_id]);
        }


    }

    public function appLogin(Request $request){
        if($request->token !=Common::TOKEN_AUTHENTICATION){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }
        if($request->user_id == ''){
            return json_encode(['status'=>401,'reason'=>'User id required']);
        }

        $user_id = base64_decode($request->user_id);
        $passcode = base64_decode($request->passcode);
        $imei = base64_decode($request->imei);

        $user = User::where('user_id',$user_id)
            ->where('passcode', MD5($passcode))
            ->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Authentication failed']);
        }
        else{
            if($request->oauth_token == ''){
                $oauth_token = $this->generateOauthToken();

                //Start. Add data on user session table
                $userSession = NEW UserSession();
                $userSession->user_id = $user->id;
                $userSession->oauth_token = $oauth_token;
                $userSession->created_at = date('Y-m-d h:i:s');
                $userSession->save();
                //End. Add data on user session table
            }
            else{
                $oauth_token = $user->active_oauth_token;
            }

            /*Update user oauth token and last login time.*/
            $updateUser = User::where('id',$user->id)->first();
            $updateUser->active_oauth_token = $oauth_token;
            $updateUser->last_login_time = date('Y-m-d h:i:s');
            $updateUser->save();

            //Update login log table
            $log = NEW Login_log();
            $log->user_id = $user->id;
            $log->login_time = date('Y-m-d h:i:s');

            return json_encode(['status'=>200,'reason'=>'Successfully Authenticated','user_id'=>$user->id,'imei'=>$imei,'oauth_token'=>$oauth_token]);
        }

    }

    public function appLogout(Request $request){
        if($request->token !=Common::TOKEN_AUTHENTICATION){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        $user_id = base64_decode($request->user_id);

        /*Check oauth token starts*/
        $user = User::where('active_oauth_token',$request->oauth_token)->first();
        if(empty($user)){
            return json_encode(['status'=>401,'reason'=>'Invalid oauth token']);
        }
        /*Check oauth token ends*/

        $user = User::where('id',$user_id)->first();
        //$user->is_login = 0;
        $user->last_logout_time = date('Y-m-d h:i:s');
        $user->active_oauth_token = '';
        $user->save();

        //Update login log table
        $log = NEW Login_log();
        $log->user_id = $user->id;
        $log->logout_time = date('Y-m-d h:i:s');

        return json_encode(['status'=>200,'reason'=>'User logged out']);
    }

    public function forceLogout(Request $request){
        if($request->token !=Common::TOKEN_AUTHENTICATION){
            return json_encode(['status'=>401,'reason'=>'Invalid token']);
        }

        $user_id = base64_decode($request->user_id);

        $user = User::where('id',$user_id)->first();
        //$user->is_login = 0;
        $user->last_logout_time = date('Y-m-d h:i:s');
        $user->save();

        //Update login log table
        $log = NEW Login_log();
        $log->user_id = $user->id;
        $log->logout_time = date('Y-m-d h:i:s');

        return json_encode(['status'=>200,'reason'=>'User logged out']);
    }

    private function generateOauthToken(){
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 8; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        $oauth_token = base64_encode($string);
        return $oauth_token;
    }
}
