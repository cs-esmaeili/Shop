<?php

namespace App\Http\Controllers;


use App\Http\Controllers\SmsClasses\SendMessage;
use App\Http\Controllers\SmsClasses\UltraFastSend;
use App\Models\log_sms;
use App\Models\user;


class Sms
{
    public static $texts = [
        'signup' => "چی مارکت \n کد تایید: {code}", //18242
        'paymentEnd' => "چی مارکت \n خرید شما با موفقیت ثبت شد \n شماره تراکنش: {RefID} \n کد سفارش: {factor_id}", //18243
        'Courier' => "چی مارکت \n سفارش شما باکدسفارش: {code} تحویل داده شد باتشکر از خرید شما", //18244
        'paymentEndOff' => "چی مارکت \n خرید شما با موفقیت ثبت شد \n کد سفارش: {factor_id}", //18245
    ];


    public static function slow_sms($admin_id = null, $user_id = null, $phonenumber = null, $message, $variables)
    {

        foreach ($variables as $key => $value) {
            $message = str_replace('{' . $key . '}', $value, $message);
        }

        if ($user_id == null && $phonenumber == null) {
            return false;
        }


        if ($user_id != null) {
            $result = user::find($user_id);
            $phonenumber = $result->username;

        } else {
            $user_id = "null";
        }

        if ($admin_id == null) {
            $admin_id = 'system';
        }


        try {
            date_default_timezone_set("Asia/Tehran");

            // include_once("SmsClasses/SendMessage.php");

            // your sms.ir panel configuration
            $APIKey = "e14187db4ce31bffcb3b87db";
            $SecretKey = "kldfg345i~!!~324/*ssSfsd.><//";
            $LineNumber = env('SMS_NUMBER');

            // your mobile numbers
            $MobileNumbers = array($phonenumber);

            // your text messages
            $Messages = array($message);

            // sending date
            $SendDateTime = date("Y-m-d") . "T" . date("H:i:s");


            $SmsIR_SendMessage = new SendMessage($APIKey, $SecretKey, $LineNumber);
            $SendMessage = $SmsIR_SendMessage->SendMessage($MobileNumbers, $Messages, $SendDateTime);
            //var_dump($SendMessage);

            self::addSmsLog($admin_id, $user_id, $phonenumber, $message);

            return true;
        } catch (Exeption $e) {
            //echo 'Error SendMessage : '.$e->getMessage();
            return true;
        }

    }

    public static function fast_sms($admin_id = null, $user_id = null, $phonenumber = null, $templateid, $variables)
    {
        $Parameters = array();

        foreach ($variables as $key => $value) {
            $param = array(
                'Parameter' => $key,
                'ParameterValue' => $value,
            );
            $Parameters[] = $param;
        }

        if ($user_id == null && $phonenumber == null) {
            return false;
        }


        if ($user_id != null) {
            $result = user::find($user_id);
            $phonenumber = $result->username;

        } else {
            $user_id = "null";
        }

        if ($admin_id == null) {
            $admin_id = 'system';
        }
        try {
            date_default_timezone_set("Asia/Tehran");
            $APIKey = "e14187db4ce31bffcb3b87db";
            $SecretKey = "kldfg345i~!!~324/*ssSfsd.><//";
            $MobileNumber = $phonenumber;


            $SmsIR_SendMessage = new UltraFastSend($APIKey, $SecretKey);
            $SendMessage = $SmsIR_SendMessage->UltraFastSend($templateid, $MobileNumber, $Parameters);

            self::addSmsLog($admin_id, $user_id, $phonenumber, "قالب : " . $templateid);

            return true;
        } catch (Exeption $e) {
            //echo 'Error SendMessage : '.$e->getMessage();
            return true;
        }
    }

    private static function addSmsLog($admin_id, $user_id, $phonenumber, $message)
    {
        $result = log_sms::create([
            'sender' => $admin_id,
            'user_id' => $user_id,
            'phone_number' => $phonenumber,
            'text' => $message,
        ])->save();
        return true;
    }
}
