<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\Utility;
use Session;
use Hash;
use Auth;

class HomeController extends Controller
{

    //Client View
    public function index(){
        $data['page'] = 'Home';
        return view('home',$data);
    }

    public function login(){
        return view('login');
    }

    public function postLogin(Request $request){
        $result = Auth::attempt(['user_id' => trim($request->username),
            'password' => $request->password,
        ], $request->has('remember'));

        if($result){
            $user = Auth::user();
            Session::put('id',$user->id);
            Session::put('role_id',$user->role_id);
            Session::put('first_name',$user->first_name);
            Session::put('last_name',$user->last_name);
            return ['status'=>200,'reason'=>'Successfully Authenticated'];
        }
        else{
            return ['status'=>401,'reason'=>'Invalid credentials'];
        }
    }

    public function logout(){
        Auth::logout();

        Session::forget('id');
        Session::forget('first_name');
        Session::forget('last_name');

        return redirect('login');
    }

    public function profile(){
        $data['page'] = 'Profile';
        return view('profile',$data);
    }

    //settings
    public function createDspDay(){
        $data['page'] = 'Setting';
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),43)){
            return redirect('404_page');
        }
        return view('create_dspDay',$data);
    }
    public function generalSpDayType(){
        $data['page'] = 'Setting';
        return view('general_sp_day_type',$data);
    }

    //Report
    public function topProducts(){
        $data['page'] = 'Dashboard';
        return view('top_products',$data);
    }

    public function notifications(){
        $data['page'] = 'Notification';
        return view('notifications',$data);
    }
    public function massageTemplate(){
        if(!Utility::userRolePermission(Session::get('role_id'),71)){
            return redirect('404_page');
        }
        $data['page'] = 'Setting';
        return view('massage_template',$data);
    }

    public function page_404(){
        $data['page'] = '404';
        return view('404_page',$data);
    }
    
}
