<?php

namespace App\Http\Controllers;


use App\Models\user;
use App\Models\user_reset_password;
use App\Models\user_signup;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MyWorkerThreads;


class UserAuthentication extends Controller
{

    public static function login(Request $request)
    {

        $result = DB::table('user')
            ->where('username', '=', G::changeWords($request->username))
            ->where('password', '=', G::getHash(G::changeWords($request->password)))
            ->get();

        if ($result->count() == 0) {
            $result = DB::table('user')
                ->where('username', '=', G::changeWords($request->username))
                ->get();
            if ($result->count() == 0) {
                return response(['status' => 'wrong'], 404);
            }else{
                return response(['status' => 'notexist'], 404);
            }

        } else if ($result->get(0)->ban == "yes") {
            return response(['status' => 'ban'], 200);
        }
        $token = G::getHash($request->username . rand(0, 1000) . now());
        if($result->get(0)->token == null || $result->get(0)->token == ""){
            $result = DB::table('user')
                ->where('username', '=', G::changeWords($request->username))
                ->where('password', '=', G::getHash(G::changeWords($request->password)))
                ->update(['token' => $token]);
        }else{
            $token = $result->get(0)->token;
        }
        return response(['status' => 'ok', 'token' => $token], 200);
    }

    public static function signup(Request $request)
    {

        $result = DB::transaction(function () use ($request) {
            $result = DB::table('user')
                ->where('username', '=', G::changeWords($request->username))
                ->get();

            if ($result->count() > 0) {
                return response(['status' => "Account available"], 200);
            }

            $result = user_signup::where('username', '=', G::changeWords($request->username))->get();

            if ($result->count() > 0) {
                if (Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration)->lessThan(Carbon::now())) {

                    if ($result->get(0)->number_try == 5) {
                        return response(['status' => 'ban'], 200);
                    }
                    $token = rand(10000, 99999);

                    user_signup::where('username', '=', G::changeWords($request->username))
                        ->where('password', '=', G::getHash(G::changeWords($request->password)))
                        ->update([
                            'token' => $token,
                            'expiration' => Carbon::now()->addMinutes(2)->format('Y-m-d H:i:s'),
                            'sent' => 'no',
                            'number_try' => $result->get(0)->number_try + 1,
                        ]);
                    return response(['status' => 'ok'], 200);
                } else {
                    $remaning = Carbon::now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration));
                    return response(['status' => 'ok', 'remaining_time' => $remaning], 200);
                }
            }

            $token = rand(10000, 99999);

            $result = user_signup::firstOrNew([
                'username' => G::changeWords($request->username),
                'password' => G::getHash(G::changeWords($request->password)),
                'token' => $token,
                'expiration' => Carbon::now()->addMinutes(2)->format('Y-m-d H:i:s'),
                'sent' => 'no',
                'number_try' => '1',
            ])->save();


            return response(['status' => 'ok'], 200);

        });

        return $result;
    }

    public static function signupCodeSender(Request $request)
    {

        $result = user_signup::where('username', '=', G::changeWords($request->username))->get();

        if ($result->count() == 0 || $result->get(0)['sent'] == "yes") {
            return response(['status' => 'fail'], 400);
        }
        if (Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration)->lessThan(Carbon::now())) {
            return response(['status' => 'expired'], 400);
        }
        user_signup::where('username', '=', G::changeWords($request->username))
            ->update([
                'sent' => 'yes',
            ]);

        $token = $result->get(0)['token'];

        if (is_int((int)G::changeWords($request->username)) && (strpos(G::changeWords($request->username), '09') !== false) && strlen(G::changeWords($request->username)) == 11) {
            $result = Sms::fast_sms(0, null, G::changeWords($request->username), '18242', ['code' => $token]);
            //$result = Sms::slow_sms(0, null, G::changeWords($request->username), Sms::$texts['signup'], ['code' => $token]);
        } else if ((strpos(G::changeWords($request->username), '@gmail.com') !== false) || (strpos(G::changeWords($request->username), '@yahoo.com') !== false)) {
            $result = Mail::sendMail(0, null, G::changeWords($request->username), Sms::$texts['signup'], ['code' => $token]);
        }


        if ($result) {
            return response(['status' => 'ok'], 200);
        }
        return response(['status' => 'fail'], 400);
    }

    public static function signupVerify(Request $request)
    {
        $result = DB::transaction(function () use ($request) {

            $result = user_signup::where('username', '=', G::changeWords($request->username))
                ->where('token', '=', $request->token)
                ->get();

            if ($result->count() > 0) {

                if (Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration)->lessThan(Carbon::now())) {
                    return response(['status' => 'expired'], 400);
                }
                user::create([
                    'username' => G::changeWords($request->username),
                    'password' => $result->get(0)->password,
                    'token' => '',
                    'ban' => 'no',
                    'description' => '',
                ]);

                $result = user_signup::where('username', '=', G::changeWords($request->username))
                    ->where('token', '=', $request->token)
                    ->delete();

                return response(['status' => 'ok'], 200);
            }
            return response(['status' => 'fail'], 400);
        });
        return $result;
    }

    public static function resetPassword(Request $request)
    {
        $result = DB::transaction(function () use ($request) {

            $result = DB::table('user')
                ->where('username', '=', G::changeWords($request->username))
                ->get();

            if ($result->count() == 0) {
                return response(['status' => 'notexist'], 404);
            } else if ($result->get(0)->ban == "yes") {
                return response(['status' => 'ban'], 200);
            }

            $result = user_reset_password::where('username', '=', G::changeWords($request->username))->get();

            if ($result->count() > 0) {
                if (Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration)->lessThan(Carbon::now())) {

                    if ($result->get(0)->number_try == 5) {
                        return response(['status' => 'ban'], 200);
                    }
                    $token = rand(10000, 99999);

                    user_reset_password::where('username', '=', G::changeWords($request->username))
                        ->update([
                            'token' => $token,
                            'expiration' => Carbon::now()->addMinutes(2)->format('Y-m-d H:i:s'),
                            'sent' => 'no',
                            'number_try' => $result->get(0)->number_try + 1,
                        ]);
                    return response(['status' => 'ok'], 200);
                } else {
                    $remaning = Carbon::now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration));
                    return response(['status' => 'ok', 'remaining_time' => $remaning], 200);
                }
            }

            $token = rand(10000, 99999);

            $result = user_reset_password::firstOrNew([
                'username' => G::changeWords($request->username),
                'token' => $token,
                'expiration' => Carbon::now()->addMinutes(2)->format('Y-m-d H:i:s'),
                'sent' => 'no',
                'number_try' => '1',
            ])->save();


            return response(['status' => 'ok'], 200);

        });

        return $result;
    }

    public  static  function resetPasswordCodeSender(Request $request)
    {
        $result = DB::table('user')
            ->where('username', '=', G::changeWords($request->username))
            ->get();

        if ($result->count() == 0) {
            return response(['status' => 'notexist'], 404);
        } else if ($result->get(0)->ban == "yes") {
            return response(['status' => 'ban'], 200);
        }

        $result = user_reset_password::where('username', '=', G::changeWords($request->username))->get();

        if ($result->count() == 0 || $result->get(0)['sent'] == "yes") {
            return response(['status' => 'fail'], 400);
        }

        if (Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration)->lessThan(Carbon::now())) {
            return response(['status' => 'expired'], 400);
        }

        user_reset_password::where('username', '=', G::changeWords($request->username))
            ->update([
                'sent' => 'yes',
            ]);

        $token = $result->get(0)['token'];

        if (is_int((int)G::changeWords($request->username)) && (strpos(G::changeWords($request->username), '09') !== false) && strlen(G::changeWords($request->username)) == 11) {
          //  $result = Sms::slow_sms(0, null, G::changeWords($request->username), Sms::$texts['signup'], ['code' => $token]);
            $result = Sms::fast_sms(0, null, G::changeWords($request->username), '18242', ['code' => $token]);
        } else if ((strpos(G::changeWords($request->username), '@gmail.com') !== false) || (strpos(G::changeWords($request->username), '@yahoo.com') !== false)) {
            $result = Mail::sendMail(0, null, G::changeWords($request->username), Sms::$texts['signup'], ['code' => $token]);
        }


        if ($result) {
            return response(['status' => 'ok'], 200);
        }
        return response(['status' => 'fail'], 400);
    }

    public static function  resetPasswordVerify(Request $request)
    {
        $result = DB::transaction(function () use ($request) {

            $result = DB::table('user')
                ->where('username', '=', G::changeWords($request->username))
                ->get();

            if ($result->count() == 0) {
                return response(['status' => 'notexist'], 404);
            } else if ($result->get(0)->ban == "yes") {
                return response(['status' => 'ban'], 200);
            }

            $result = user_reset_password::where('username', '=', G::changeWords($request->username))
                ->where('token', '=', $request->token)
                ->get();


            if ($result->count() > 0) {

                if (Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration)->lessThan(Carbon::now())) {
                     return response(['status' => 'expired'], 400);
                }

                $token = G::getHash(G::changeWords($request->username) . rand(10000, 99999) . Carbon::now());
                user_reset_password::where('username', '=', G::changeWords($request->username))
                    ->update([
                        'token' => $token,
                        'expiration' => Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s'),
                    ]);

                return response(['status' => 'ok', 'token' => $token], 200);
            }
            return response(['status' => 'fail'], 400);
        });
        return $result;
    }

    public static function resetPasswordAction(Request $request)
    {
        $result = DB::transaction(function () use ($request) {

            $result = DB::table('user')
                ->where('username', '=', G::changeWords($request->username))
                ->get();

            if ($result->count() == 0) {
                return response(['status' => 'notexist'], 404);
            } else if ($result->get(0)->ban == "yes") {
                return response(['status' => 'ban'], 200);
            }

            $result = user_reset_password::where('username', '=', G::changeWords($request->username))
                ->where('token', '=', $request->token)
                ->get();

            if ($result->count() > 0) {

                if (Carbon::createFromFormat('Y-m-d H:i:s', $result->get(0)->expiration)->lessThan(Carbon::now())) {
                    return response(['status' => 'expired'], 400);
                }


                $result = user_reset_password::where('username', '=', G::changeWords($request->username))
                    ->where('token', '=', $request->token)
                    ->update([
                        'token' => '',
                        'expiration' => Carbon::now(),
                        'sent' => 'no',
                    ]);

                $result = user::where('username', '=', G::changeWords($request->username))
                    ->update([
                        'password' => G::getHash(G::changeWords($request->password)),
                        'token' => '',
                    ]);

                return response(['status' => 'ok'], 200);
            }
            return response(['status' => 'fail'], 400);
        });
        return $result;
    }
}

