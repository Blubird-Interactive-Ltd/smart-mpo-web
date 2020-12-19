<?php

namespace App;
use Illuminate\Support\Facades\Mail;
use Session;

/**
 * Class SendMails, this class is to send various types of mails
 *
 * @package App
 */
class Common
{
    const TOKEN_AUTHENTICATION = 'TA12345678';
    const TOKEN_DOCTOR = 'TD12345678';
    const TOKEN_CHEMIST = 'TC12345678';
    const TOKEN_DOCTOR_DCR = 'TDDCR12345678';
    const TOKEN_CHEMIST_DCR = 'TCDCR12345678';
    const TOKEN_TERRITORY = 'TT12345678';
    const TOKEN_PRODUCT = 'TPR12345678';
    const TOKEN_PRESCRIPTIONS = 'TP12345678';
    const TOKEN_REPORT = 'TR12345678';
    const TOKEN_ADDRESS = 'TAD12345678';
    const TOKEN_TEMPLATE = 'TT12345678';
    const TOKEN_USER = 'TU12345678';

    public static function getActivePaymentGetway()
    {
        try{
            $setting = Setting::first();
            return $setting->payment_getway;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

}