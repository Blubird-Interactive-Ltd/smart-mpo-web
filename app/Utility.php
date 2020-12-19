<?php

namespace App;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\models\RoleFeature;

/**
 * Class Common, this class is to use project common functions
 *
 * @package App
 */
class Utility
{
    const key = 'BlubirdInteractiveLimite';
    const encrypt_method = 'AES-256-CBC';
    const iv = 'Blubird';

    public static function encrypt_string($string){
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        return $output;
    }

    public static function decrypt_string($string){
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt($string, $encrypt_method, $key, 0, $iv);
        return $output;
    }

    //User input sanitization
    public static function sanitize_number($number) {
        return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function sanitize_decimal($decimal) {
        return filter_var($decimal, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function sanitize_string($string) {
        $string = strip_tags($string);
        $string = addslashes($string);
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public static function sanitize_html($string) {
        $string = strip_tags($string, '<a><strong><em><hr><br><p><u><ul><ol><li><dl><dt><dd><table><thead><tr><th><tbody><td><tfoot><b>');
       return $string = addslashes($string);
       // return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public static function sanitize_url($url) {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    public static function sanitize_slug($string) {
        $string = str_slug($string);
        return filter_var($string, FILTER_SANITIZE_URL);
    }

    public static function sanitize_email($string) {
        return filter_var($string, FILTER_SANITIZE_EMAIL);
    }

    public static function sanitize_encoded($string) {
        return filter_var($string, FILTER_SANITIZE_ENCODED);
    }

    public static function sanitize_noHtml($string) {
        $string = strip_tags($string, '<a><strong><em><hr><br><p><u><ul><ol><li><dl><dt><dd><table><thead><tr><th><tbody><td><tfoot><b>');
        return filter_var($string, FILTER_SANITIZE_STRING);
    }


    public static function databaseDate($var){
        $date = str_replace('/', '-', $var);
        return date('Y-d-m', strtotime($date));
    }

    public static function userRolePermission($role_id,$action_id){
        $permission = RoleFeature::where('role_id',$role_id)->where('action_id',$action_id)->first();
        if(empty($permission)){
            return false;
        }
        else{
            return true;
        }
    }

    public static function getMpos($role_id,$id){
        if($role_id==4){ // If am logged in
            $mpos = User::select('id')->where('parent_id',$id)->pluck('id')->toArray();
        }
        else if($role_id==3){ // If rsm logged in
            // Get all am ids associate with the rsm
            $all_am = User::select('id')->where('parent_id',$id)->where('status','active')->pluck('id')->toArray();
            // Get all mpo ids associate with the all_am
            $mpos = User::select('id')->whereIn('parent_id',$all_am)->where('status','active')->pluck('id')->toArray();
        }
        else if($role_id==2){ // If zsm logged in
            // Get all rsm ids associate with the zsm
            $all_rsm = User::select('id')->where('parent_id',$id)->where('status','active')->pluck('id')->toArray();
            // Get all am ids associate with the rsm
            $all_am = User::select('id')->whereIn('parent_id',$all_rsm)->pluck('id')->where('status','active')->toArray();
            // Get all mpo ids associate with the all_am
            $mpos = User::select('id')->whereIn('parent_id',$all_am)->where('status','active')->pluck('id')->toArray();
        }
        else{
            $mpos = User::select('id')->where('status','active')->where('role_id',5)->pluck('id')->toArray();
        }

        return $mpos;
    }

    public static function getAms($role_id,$id){
        if($role_id==4){ // If am logged in
            $ams = array($id);
        }
        else if($role_id==3){ // If rsm logged in
            // Get all am ids associate with the rsm
            $ams = User::select('id')->where('parent_id',$id)->where('status','active')->pluck('id')->toArray();
        }
        else if($role_id==2){ // If zsm logged in
            // Get all rsm ids associate with the zsm
            $all_rsm = User::select('id')->where('parent_id',$id)->where('status','active')->pluck('id')->toArray();
            // Get all am ids associate with the rsm
            $ams = User::select('id')->whereIn('parent_id',$all_rsm)->pluck('id')->where('status','active')->toArray();
        }
        else{
            $ams = User::select('id')->where('status','active')->where('role_id',4)->pluck('id')->toArray();
        }

        return $ams;
    }



}

?>