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
    const iv = 'Blubird';
    const cipher = 'aes-128-gcm';

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



}

?>