<?php

namespace App\Http\Controllers;


use App\Models\log_email;
use App\Models\user;


class Mail
{
    public static $texts = [
        'signup' => "چی مارکت \n کد تایید: {code}", //18242
        'paymentEnd' => "چی مارکت \n خرید شما با موفقیت ثبت شد \n شماره تراکنش: {RefID} \n کد سفارش: {factor_id}", //18243
        'Courier' => "چی مارکت \n سفارش شما باکدسفارش: {code} تحویل داده شد باتشکر از خرید شما", //18244
        'paymentEndOff' => "چی مارکت \n خرید شما با موفقیت ثبت شد \n کد سفارش: {factor_id}", //18245
    ];

    public static function sendMail($admin_id = null, $user_id = null, $target_email = null, $message, $variables)
    {

        foreach ($variables as $key => $value) {
            $message = str_replace('{' . $key . '}', $value, $message);
        }

        if ($user_id == null && $target_email == null) {
            return false;
        }


        if ($user_id != null) {
            $result = user::find($user_id);
            $email = $result->username;
        } else {
            $user_id = "null";
        }

        if ($admin_id == null) {
            $admin_id = 'system';
        }
        self::addMailLog($admin_id, $user_id, $target_email, $message);

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $from = env('MAIL');
        $headers = "From:" . $from;

        mail($target_email, 'چی مارکت', $message, $headers);

        return true;

    }

    private static function addMailLog($admin_id, $user_id, $target_email, $message)
    {

        $result = log_email::create([
            'sender' => $admin_id,
            'user_id' => $user_id,
            'target_email' => $target_email,
            'text' => $message,
        ])->save();

        return true;
    }
}
