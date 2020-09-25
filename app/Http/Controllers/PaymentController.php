<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\card_information;
use App\Models\circleorder;
use App\Models\factor;
use App\Models\factor_product;
use App\Models\factor_status;
use App\Models\product;
use App\Models\user_address;
use App\Models\user_cart;
use App\Models\user_journal;
use App\Models\user_journal_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SoapClient;

class PaymentController extends Controller
{
    public static function start(Request $request)
    {

        $result = DB::transaction(function () use ($request) {
            $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
            user_cart::where('user_id', '=', $userid)->delete();
            $addressid = $request->address_id;
            $products = $request->products;
            $date = $request->date;
            $description = null;
            if ($request->description == null) {
                $description = "";
            } else {
                $description = $request->description;
            }


            $jsontext = $products;
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);

            $price = 0;
            foreach ($decoded as $key => $value) {
                $result = G::getProduct_MinimumData($value->kalaId, [])->toArray();
                if ($result['status'] == 3) {
                    return false;

                } else if ($value->Tedad > $result['stock'] || $value->Tedad > $result['order_number']) {
                    return false;
                }
                $price = $price + ($result['price'] * $value->Tedad);
            }


            if ($price <= G::$max_price) {
                $price += G::$cour_price;
            }

            $Description = 'چی مارکت';
            $CallbackURL = env('APP_URL') . "api/user/payment/end/" . $request->token . "/";


            if ($request->payment == "false") {

                return PaymentController::paymentoff($userid, $addressid, $decoded, $date, $description) == true ?
                    env('APP_URL') . "successful/0"
                    :
                    env('APP_URL') . "unsuccessful";
            }

            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);


            $result = $client->PaymentRequest(
                [
                    'MerchantID' => env('MerchantID'),
                    'Amount' => $price,
                    'Description' => $Description,
                    'Email' => '',
                    'Mobile' => '',
                    'CallbackURL' => $CallbackURL,
                ]
            );

            if ($result->Status == 100) {
                $AUcode = $result->Authority;

                $result = user_address::where('user_address_id', '=', $addressid)->get();


                $result = user_journal::create([
                    'user_id' => $userid,
                    'name' => $result->get(0)->name,
                    'phone_number' => $result->get(0)->phone_number,
                    'home_number' => $result->get(0)->home_number,
                    'state' => $result->get(0)->state,
                    'city' => $result->get(0)->city,
                    'postal_code' => $result->get(0)->postal_code,
                    'address' => $result->get(0)->address,
                    'description' => $description,
                    'authority_code' => $AUcode,
                    'ref_id' => "",
                    'done' => 'no',
                    'datetime' => $date,
                ]);

                foreach ($decoded as $key => $value) {
                    $resultp = G::getProduct_MinimumData($value->kalaId, [])->toArray();
                    user_journal_product::create([
                        'user_journal_id' => $result->user_journal_id,
                        'product_id' => $resultp['product_id'],
                        'number' => $value->Tedad,
                        'price' => $resultp['price'],
                        'old_price' => $resultp['old_price'],
                    ]);
                }
                foreach ($decoded as $key => $value) {


                    $result = G::getProduct_MinimumData($value->kalaId, [])->toArray();


                    $order_number = $result['order_number'];
                    if ($result['stock'] - $value->Tedad < $result['order_number']) {
                        $order_number = $result['stock'] - $value->Tedad;
                    }


                    product::where('product_id', '=', $result['product_id'])->update([
                        'stock' => ($result['stock'] - $value->Tedad),
                        'order_number' => $order_number,
                    ]);

                }

                return ("https://www.zarinpal.com/pg/StartPay/" . $AUcode . "/ZarinGate");
            } else {
                return ('ERR: ' . $result->Status);
            }

        });

        return $result;

    }


    public static function end(Request $request, $token)
    {

        $userid = G::checkToken($token) == false ? abort(response("You do not have access", 404)) : G::checkToken($token);
        $Authority = $request->get('Authority');
        $result = PaymentController::jurnaldone($userid, $Authority);

        $result = DB::transaction(function () use ($Authority, $token, $userid, $result) {


            if ($_GET['Status'] == 'OK') {
                if ($result[0]->Status == 100) {
                    return PaymentController::addorder($Authority, $result[0]->RefID, $result[1]) == true ? redirect(env('APP_URL') . "successful/" . $result[0]->RefID) : redirect(env('APP_URL') . "unsuccessful.html");
                } else {
                    $result = user_journal::where('user_id', '=', $userid)->where('authority_code', '=', $Authority)->get();
                    $result = user_journal_product::where('user_journal_id', '=', $result->get(0)['user_journal_id'])->get();
                    $user_journal_id = $result->get(0)['user_journal_id'];
                    $result->map(function ($value, $key) use ($result) {
                        $number = $value['number'];
                        $result = product::where('product_id', '=', $value['product_id'])->get();
                        $stock = $result->get(0)['stock'];
                        $stock += $number;
                        product::where('product_id', '=', $value['product_id'])
                            ->update([
                                'stock' => $stock,
                            ]);

                    });

                    return redirect(env('APP_URL') . "unsuccessful");
                }


            } else {
                $result = user_journal::where('user_id', '=', $userid)->where('authority_code', '=', $Authority)->get();
                $result = user_journal_product::where('user_journal_id', '=', $result->get(0)['user_journal_id'])->get();
                $user_journal_id = $result->get(0)['user_journal_id'];
                $result->map(function ($value, $key) use ($result) {
                    $number = $value['number'];
                    $result = product::where('product_id', '=', $value['product_id'])->get();
                    $stock = $result->get(0)['stock'];
                    $stock += $number;
                    product::where('product_id', '=', $value['product_id'])
                        ->update([
                            'stock' => $stock,
                        ]);

                });

                return redirect(env('APP_URL') . "unsuccessful");
            }

        });

        return $result;
    }

    private static function jurnaldone($userid, $Authority)
    {

        $user_journal_id = user_journal::where('user_id', '=', $userid)->where('authority_code', '=', $Authority)->where('done', '=', 'no')->get('user_journal_id');
        $products = user_journal_product::where('user_journal_id', '=', $user_journal_id->get(0)['user_journal_id'])->get();

        $price = 0;
        foreach ($products as $key => $value) {

            $price = $price + ($value['price'] * $value['number']);
        }


        if ($price <= G::$max_price) {
            $price += G::$cour_price;
        }

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentVerification(
            [
                'MerchantID' => env('MerchantID'),
                'Authority' => $Authority,
                'Amount' => $price,
            ]
        );

        if ($result->Status == 100) {
            user_journal::where('user_id', '=', $userid)->where('authority_code', '=', $Authority)->update(['done' => 'yes', 'ref_id' => $result->RefID]);
        }
        return [$result, $price];

    }

    private static function addorder($AUcode, $RefID, $price)
    {
        $selectid = G::$main_admin;
        $admins = admin::where('enabel', '=', 'yes')->where('order_come', '=', 'yes')->get();

        if ($admins->count() == 0) {
            $selectid = G::$main_admin;
        } else {

            $Circle = circleorder::find(1);

            $last = $Circle ['last'];
            $selectid = $last;

            $minid = 1;
            foreach ($admins as $key => $value) {
                $thisadminid = $value['admin_id'];
                settype($thisadminid, "integer");
                if ($thisadminid < $minid) {
                    $minid = $thisadminid;
                }
                if ($thisadminid == $last || $thisadminid < $last) {
                    continue;
                } else {
                    $selectid = $thisadminid;
                    break;
                }
            }

            if ($selectid == $last) {
                $selectid = $minid;
            }
            circleorder::where('circleorder_id', '=', 1)->update([
                'last' => $selectid,
            ]);
        }


        $result = user_journal::where('authority_code', '=', $AUcode)->where('done', '=', 'yes')->get();
        $user_id = $result->get(0)->user_id;
        $phone_number = $result->get(0)->phone_number;

        $resultf = factor::create([
            'user_id' => $result->get(0)->user_id,
            'admin_id' => $selectid,
            'name' => $result->get(0)->name,
            'phone_number' => $result->get(0)->phone_number,
            'home_number' => $result->get(0)->home_number,
            'state' => $result->get(0)->state,
            'city' => $result->get(0)->city,
            'postal_code' => $result->get(0)->postal_code,
            'address' => $result->get(0)->address,
            'description' => $result->get(0)->description,
            'ref_id' => $RefID,
            'datetime' => $result->get(0)->datetime,
            'status' => 1,
            'rate' => 0.0,
            'total_Price' => ($price /*- G::$cour_price*/),
            'difference_status' => 'nothing',
        ]);


        $result = user_journal_product::where('user_journal_id', '=', $result->get(0)->user_journal_id)->get();

        $result->map(function ($key, $value) use ($result, $resultf) {

            $product = product::where('product_id', '=', $key->product_id)->get();

            $result = factor_product::create([
                'factor_id' => $resultf->factor_id,
                'product_id' => $key->product_id,
                'number' => $key->number,
                'price' => $key->price,
                'old_price' => $key->old_price,
                'weight' => $product->get(0)['weight'],
                'status' => 'admin',
                'payment' => 'yes',
                'payment_weight_change' => 'no',
            ]);

        });

        $result = user_journal::where('authority_code', '=', $AUcode)->get();

        //  $result = Sms::slow_sms(0, $user_id, $phone_number, Sms::$texts['paymentEnd'], ['factor_id' => $resultf->factor_id, 'RefID' => $RefID]);
        $result = Sms::fast_sms(0, $user_id, G::changeWords($phone_number), '18243', ['factor_id' => $resultf->factor_id, 'RefID' => $RefID]);
        return $result;
    }

    private static function paymentoff($userid, $addressid, $decoded, $date, $description)
    {

        $selectid = G::$main_admin;
        $admins = admin::where('enabel', '=', 'yes')->where('order_come', '=', 'yes')->get();

        if ($admins->count() == 0) {
            $selectid = G::$main_admin;
        } else {

            $Circle = circleorder::find(1);

            $last = $Circle ['last'];
            $selectid = $last;

            $minid = 1;
            foreach ($admins as $key => $value) {
                $thisadminid = $value['admin_id'];
                settype($thisadminid, "integer");
                if ($thisadminid < $minid) {
                    $minid = $thisadminid;
                }
                if ($thisadminid == $last || $thisadminid < $last) {
                    continue;
                } else {
                    $selectid = $thisadminid;
                    break;
                }
            }

            if ($selectid == $last) {
                $selectid = $minid;
            }
            circleorder::where('circleorder_id', '=', 1)->update([
                'last' => $selectid,
            ]);
        }


        $result = user_address::where('user_address_id', '=', $addressid)->get();
        $phone_number = $result->get(0)->phone_number;
        $resultf = factor::create([
            'user_id' => $userid,
            'admin_id' => $selectid,
            'name' => $result->get(0)->name,
            'phone_number' => $result->get(0)->phone_number,
            'home_number' => $result->get(0)->home_number,
            'state' => $result->get(0)->state,
            'city' => $result->get(0)->city,
            'postal_code' => $result->get(0)->postal_code,
            'address' => $result->get(0)->address,
            'description' => $description,
            'ref_id' => "پرداخت حضوری",
            'datetime' => $date,
            'status' => 1,
            'rate' => 0.0,
            'total_Price' => 0,
            'difference_status' => 'nothing',
        ]);


        foreach ($decoded as $key => $value) {
            $resultp = G::getProduct_MinimumData($value->kalaId, [])->toArray();

            $product = product::where('product_id', '=', $resultp['product_id'])->get();

            factor_product::create([
                'factor_id' => $resultf->factor_id,
                'product_id' => $resultp['product_id'],
                'number' => $value->Tedad,
                'price' => $resultp['price'],
                'old_price' => $resultp['old_price'],
                'weight' => $product->get(0)['weight'],
                'status' => 'admin',
                'payment' => 'no',
                'payment_weight_change' => 'no',
            ]);
        }


        foreach ($decoded as $key => $value) {


            $result = G::getProduct_MinimumData($value->kalaId, [])->toArray();


            $order_number = $result['order_number'];
            if ($result['stock'] - $value->Tedad < $result['order_number']) {
                $order_number = $result['stock'] - $value->Tedad;
            }


            product::where('product_id', '=', $result['product_id'])->update([
                'stock' => ($result['stock'] - $value->Tedad),
                'order_number' => $order_number,
            ]);

        }
        //   $result = Sms::slow_sms(0, $userid, $phone_number, Sms::$texts['paymentEndOff'], ['factor_id' => $resultf->factor_id]);
        $result = Sms::fast_sms(0, $userid, G::changeWords($phone_number), '18245', ['factor_id' => $resultf->factor_id]);
        return true;

    }
}
