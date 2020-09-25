<?php

namespace App\Http\Controllers;

use App\Models\card_information;
use App\Models\factor;
use App\Models\factor_product;
use App\Models\firstpage;
use App\Models\intromess;
use App\Models\main_category;
use App\Models\Models\view;
use App\Models\payment_date;
use App\Models\payment_time;
use App\Models\product;
use App\Models\sub_category;
use App\Models\user_address;
use App\Models\user_cart;
use App\Models\user_favorites;
use App\Models\user_message;
use App\Models\weight_transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use SoapClient;

class UserController extends Controller
{
    public function firstPage()
    {
        $result = firstpage::all();

        $record = $result->map(function ($value, $key) {
            $collect = collect($value);
            if ($value['product_id'] !== 0) {

                $product = G::getProduct_MinimumData($value['product_id'], ['description', 'order_number', 'category', 'stock']);

                if ($product != false) {
                    $product->each(function ($value, $key) use ($collect) {
                        $collect->put($key, $value);
                    });
                }
            }
            if ($collect['post_image'] != "") {
                $collect['post_image'] = env('APP_URL') . "images/firstpage/" . $collect['post_image'];
            }
            return $collect;

        });

        return $record;

    }

    public function versionControl(Request $request)
    {
        $result = intromess::where('VERSIONNAME', $request->VERSIONNAME)->where('message_id', '!=', $request->message_id)->get();
        if ($request->message_id == "-1" && $result->first()->type != "update") {
            return ['message_id' => $result->first()->message_id];
        }
        return ($result->count() == 0) ? "[]" : $result->first();
    }

    public static function mainCategory(Request $request)
    {
        if ($request->page == "first") {
            $result = main_category::where('firstpage', 'yes')->get(['title', 'image', 'firstpage_index', 'main_category_id']);
            $result = collect($result);
            $result = $result->map(function ($value, $key) {
                $value['image'] = env('APP_URL') . "images/category/" . $value['image'];
                return $value;
            });
            return $result;
        } else if ($request->page == "main") {
            $result = main_category::where('category', 'yes')->get(['title', 'image', 'category_index', 'main_category_id'])->toArray();
            $result = collect($result);
            $result = $result->map(function ($value, $key) {
                $value['image'] = env('APP_URL') . "images/category/" . $value['image'];
                return $value;
            });
            return $result;
        }
    }

    public function product($product_id)
    {
        $result = G::getProduct_MinimumData($product_id, ['stock'])->toArray();
        return $result;
    }

    public function productImages($folder)
    {

        $a = scandir(dirname(__DIR__, 4) . "/public_html/images/" . $folder);
        $array = array();
        for ($i = 2; $i < sizeof($a); $i++) {
            $array[] = env('APP_URL') . "images/" . $folder . "/" . $a[$i];
        }

        return $array;
    }

    public function product_favorite_check(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $temp = user_favorites::where('user_id', '=', $userid)->where('product_id', '=', $request->product_id)->get();
        if ($temp->count() == 1) {
            return "yes";
        } else {
            return "no";
        }
    }

    public static function subCategory($main_category_id)
    {

        $result = DB::select("SELECT * FROM `sub_category` WHERE `main_category_id`=:id", ['id' => $main_category_id]);
        $result = collect($result);
        $result = $result->map(function ($value, $key) {

            $value->image = env('APP_URL') . "images/subcategory/" . $value->image;
            return $value;
        });
        return $result;
    }

    public static function productList(Request $request)
    {

        $value = $request->value;
        $number = $request->number;
        $sort = $request->sort;
        $result = null;


        if ($sort == "Nothing") {
            $result = DB::select(" SELECT * FROM `product` WHERE  `category` =:value", ['value' => $value]);
        } else if ($sort == "Ascending") {
            $result = DB::select(" SELECT * FROM `product`WHERE `category` = :value   ORDER BY Price", ['value' => $value]);
        } else if ($sort == "Descending") {
            $result = DB::select(" SELECT * FROM `product`WHERE `category` = :value   ORDER BY Price DESC", ['value' => $value]);
        }

        $output = array();
        foreach ($result as $key => $value) {
            $temp = (G::getProduct_MinimumData($value->product_id, ['description', 'order_number', 'category', 'stock']));
            if ($temp != false) {
                $output[] = $temp;
            }
        }


        $output_final = collect([]);
        for ($i = $number; $i < ($number + 12); $i++) {
            if ($i < collect($output)->count()) {
                $output_final->add($output[$i]);
            }
        }
        $tempsub = sub_category::where('category', '=', $request->value)->get();
        $tempmain = main_category::where('main_category_id', '=', $tempsub->get(0)['main_category_id'])->get();

        $final = Collect([])
            ->put('number', $number)
            ->put('list', intdiv(collect($output)->count(), 12) + 1)
            ->put('category', $request->value)
            ->put('title_sub', $tempsub->get(0)['title'])
            ->put('title_main', $tempmain->get(0)['title'])
            ->put('main_category_id', $tempsub->get(0)['main_category_id'])
            ->put('products', $output_final);
        return $final;

    }

    public static function search(Request $request)
    {
        $text = $request->text;
        $sort = $request->sort;

        if ($sort == "Nothing") {
            $result = DB::table('product')
                ->where('Name', 'LIKE', '%' . $text . '%')
                ->orWhere('product_id', '=', $text)
                ->get();

        } else if ($sort == "Ascending") {

            $result = DB::table('product')
                ->where('Name', 'LIKE', '%' . $text . '%')
                ->orWhere('product_id', '=', $text)
                ->orderBy('Price')
                ->get();

        } else if ($sort == "Descending") {
            $result = DB::table('product')
                ->where('Name', 'LIKE', '%' . $text . '%')
                ->orWhere('product_id', '=', $text)
                ->orderByDesc('Price')
                ->get();
        }

        $output = array();
        foreach ($result as $key => $value) {
            $temp = (G::getProduct_MinimumData($value->product_id, ['description', 'order_number', 'category', 'stock']));
            if ($temp != false) {
                $output[] = $temp;
            }
        }
        return $output;

    }

    public static function address(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);

        $result = user_address::where('user_id', '=', $userid)->get();
        return $result;
    }

    public static function addressDelete(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);

        $result = user_address::where('user_id', '=', $userid)->where('user_address_id', '=', $request->user_address_id)->delete();
        return response(['status' => 'ok'], 400);
    }

    public static function addressEdite(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = user_address::where('user_id', '=', $userid)->where('user_address_id', '=', $request->user_address_id)
            ->update([
                'name' => $request->name,
                'home_number' => $request->home_number,
                'phone_number' => $request->phone_number,
                'state' => $request->state,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
            ]);
        return response(['status' => 'ok'], 400);
    }

    public static function addressAdd(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);

        $result = user_address::create([
            'user_id' => $userid,
            'name' => $request->name,
            'home_number' => $request->home_number,
            'phone_number' => $request->phone_number,
            'state' => $request->state,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
        ]);
        return response(['status' => 'ok'], 400);
    }

    public function checkCart(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $text = json_decode($request->jsontext);
        $text = Collect($text);

        $result = $text->map(function ($value, $key) {

            $temp = collect(G::getProduct_MinimumData($value->Id, [])->toArray());
            $result = null;


            if ($temp['price'] != $value->Price
                || ($temp['order_number'] < $value->Ordernumber && $value->Tedad > $temp['order_number'])
                || $temp['stock'] < $value->Tedad) {
                if ($temp['stock'] == 0) {
                    $result = collect(['delete' => "" . $temp['product_id']]);
                } else {
                    $result = collect(G::getProduct_MinimumData($value->Id, ['stock'])->toArray());
                }

            }

            return collect($result);
        });


        $result->map(function ($value, $key) use ($result) {
            if ($value->count() == 0) {
                $result->forget($key);
            }
        });

        $arr = array_values($result->toArray());
        return $arr;
    }

    public function getTime($product_id)
    {
        $result = G::getProduct_MinimumData($product_id, ['stock'])->toArray();
        return $result['datetime'];
    }

    public static function factor(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = factor::where('user_id', '=', $userid)->get();
        for ($i = 0; $i < $result->count(); $i++) {
            if ($result[$i]['status'] == 4 || $result[$i]['status'] == 5 || $result[$i]['status'] == 6) {
                $result[$i]['status'] = 3;
            }
            $result[$i] = collect($result[$i]);

            $result[$i]->put('sum', G::factor_price($result->get($i)['factor_id'], true, false, false));
        }
        return $result;
    }


    public static function factorInformation(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = factor::where('user_id', '=', $userid)->where('factor_id', '=', $request->factor_id)->get();
        for ($i = 0; $i < $result->count(); $i++) {
            $products = factor_product::where('factor_id', '=', $result->get($i)['factor_id'])->get();
            $sum_products = collect([]);
            for ($j = 0; $j < $products->count(); $j++) {
                $resultt = product::where('product_id', '=', $products[$j]->product_id)->get();
                $resultt = collect($resultt[0]);

                $resultt->forget(['stock', 'datetime', 'status', 'category', 'description', 'order_number']);
                $resultt = $resultt->replace([
                    'price' => $products[$j]->price,
                    'old_price' => $products[$j]->old_price,
                    'image_thumbnail' => env('APP_URL') . "images/" . $resultt['image_folder'] . "/" . $resultt['image_thumbnail'],
                ]);
                $resultt->put('number', "" . $products[$j]->number);
                $sum_products->push($resultt);
            }
            if ($result[$i]['status'] == 4 || $result[$i]['status'] == 5 || $result[$i]['status'] == 6) {
                $result[$i]['status'] = 3;
            }
            $result[$i] = collect($result[$i]);
            $result[$i]->put("price", G::factor_price($result->get($i)['factor_id'], true, false, false));
            $result[$i]->put("price_weight", G::factor_price($result->get($i)['factor_id'], true, true, false));
            $result[$i]->put('products', $sum_products);

        }

        return $result;
    }

    public function factorRating(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);


        $result = factor::where('factor_id', '=', $request->factor_id)
            ->where('user_id', '=', $userid)
            ->where('rate', '=', 0.0)
            ->where('status', '=', 8)
            ->update(['rate' => $request->rate]);

        if ($result == 1) {
            return response(['status' => 'ok'], 200);
        } else {
            return response(['status' => 'fail'], 400);
        }

    }

    public static function Favorites(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $number = $request->number;
        $result = user_favorites::where('user_id', '=', $userid)
            ->offset($number)
            ->limit(12)
            ->get();
        $record = collect([]);
        $result->map(function ($value, $key) use ($record) {
            $temp = G::getProduct_MinimumData($value->product_id, ['description', 'order_number', 'category', 'stock']);
            $record->add($temp);
        });
        return $record;

    }

    public static function addFavorite(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = user_favorites::firstOrCreate(['user_id' => $userid, 'product_id' => $request->product_id]);
        if ($result->wasRecentlyCreated) {
            return response(['status' => 'ok'], 200);
        } else {
            return response(['status' => 'fail'], 400);
        }
    }

    public static function deleteFavorite(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = user_favorites::where('user_id', '=', $userid)->where('product_id', '=', $request->product_id)->delete();
        if ($result == 1) {
            return response(['status' => 'ok'], 200);
        } else {
            return response(['status' => 'fail'], 400);
        }
    }

    public function problems(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = user_message::create([
            'user_id' => $userid,
            'text' => $request->Text,
        ]);

        if ($result->wasRecentlyCreated) {
            return response(['status' => 'ok'], 200);
        } else {
            return response(['status' => 'fail'], 400);
        }
    }


    public function view(Request $request)
    {

        $date = date('Y-m-d H:i:s');
        $nameOfDay = date('l', strtotime($date));
        view::create([
            'day' => $nameOfDay,
            'location' => $request->location,
        ]);
    }

    public function save_card(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $temp = card_information::where('user_id', '=', $userid)->get();
        if ($temp->count() > 0) {
            card_information::where('user_id', '=', $userid)->update(['number' => $request->card, 'name' => $request->name]);
        } else {
            card_information::create(['user_id' => $userid, 'number' => $request->card, 'name' => $request->name]);
        }
        factor::where('factor_id', '=', $request->factor_id)->update(['status' => 5]);
        factor_product::where('factor_id', '=', $request->factor_id)->update(['weight_change_description' => "شماره کارت وارد شد"]);
        return "ok";
    }

    public function open_gate(Request $request)
    {

        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = DB::transaction(function () use ($request) {
            $price = 0;
            $factor = factor::where('factor.factor_id', '=', $request->factor_id)
                ->join('factor_product', 'factor.factor_id', 'factor_product.factor_id')
                ->select(['*'])
                ->get();


            for ($i = 0; $i < $factor->count(); $i++) {
                $price += (($factor[$i]['weight_change'] * $factor[$i]['price']) / $factor[$i]['weight']);
            }


            $Description = 'چی مارکت';
            $CallbackURL = env('APP_URL') . "api/user/close_gate/" . $request->token . "/";

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

                weight_transactions::create([
                    'factor_id' => $request->factor_id,
                    'weight_price' => $price,
                    'authority_code' => $AUcode,
                    'ref_id' => "",
                ]);

                factor::where('factor_id', '=', $request->factor_id)->update(['status' => 4]);

                return ("https://www.zarinpal.com/pg/StartPay/" . $AUcode . "/ZarinGate");
            } else {
                return ('ERR: ' . $result->Status);
            }
        });
        return $result;
    }

    public function close_gate(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = DB::transaction(function () use ($request) {
            $Authority = $request->get('Authority');
            if ($_GET['Status'] == 'OK') {
                $price = weight_transactions::where('authority_code', '=', $Authority)->get();
                $price = $price->get(0)['weight_price'];
                $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

                $result = $client->PaymentVerification(
                    [
                        'MerchantID' => env('MerchantID'),
                        'Authority' => $Authority,
                        'Amount' => $price,
                    ]
                );

                if ($result->Status == 100) {
                    weight_transactions::where('authority_code', '=', $Authority)->update(['ref_id' => $result->RefID]);
                    weight_transactions::where('weight_transactions.authority_code', '=', $Authority)
                        ->join('factor', 'weight_transactions.factor_id', '=', 'factor.factor_id')
                        ->join('factor_product', 'factor.factor_id', '=', 'factor_product.factor_id')
                        ->update(['factor.status' => 5, 'factor_product.payment_weight_change' => 'yes']);

                    weight_transactions::where('authority_code', '=', $Authority)->delete();

                    return redirect(env('APP_URL') . "successful_weight/" . $result->RefID);
                } else {

                    weight_transactions::where('weight_transactions.authority_code', '=', $Authority)
                        ->join('factor', 'weight_transactions.factor_id', '=', 'factor.factor_id')
                        ->update(['factor.status' => 6]);
                    weight_transactions::where('authority_code', '=', $Authority)->delete();
                    return redirect(env('APP_URL') . "unsuccessful_weight");
                }
            } else {
                weight_transactions::where('weight_transactions.authority_code', '=', $Authority)
                    ->join('factor', 'weight_transactions.factor_id', '=', 'factor.factor_id')
                    ->update(['factor.status' => 6]);
                weight_transactions::where('authority_code', '=', $Authority)->delete();
                return redirect(env('APP_URL') . "unsuccessful_weight");
            }
        });
        return $result;
    }

    public static function peyment_step(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $cour_price = G::$cour_price;
        $max_price = G::$max_price;
        $min_time = 9;
        $max_time = 20;

        $output = collect([]);
        $output->put('courier_price', $cour_price);
        $output->put('max_price', $max_price);
        $output->put('max_price_text', 'هزینه پیک برای خرید های بالای 75 هزار تومان رایگان است');
        $first_time = Carbon::now()->format('H');

        if ($first_time >= $min_time && $first_time < $max_time) {
            $output->put('fast', 'yes');
        } else {
            $output->put('fast', 'no');
        }


        $dates = collect([]);
        for ($i = 0; $i < 7; $i++) {
            $day = collect([]);
            $day_obj = collect([]);
            $time = Carbon::now()->add($i, 'day')->format('Y-m-d');
            $special = payment_date::where('date', '=', $time)->get();
            $day_obj->put('date', jdf::convert($time, false));
            $day_obj->put('message', '');


            if ($special->count() > 0) {
                $time = collect([]);

                $encodestr = $special->get(0)['time'];
                $day_obj->put('message', $special->get(0)['message']);
                for ($k = 0; $k < strlen($encodestr); $k++) {
                    $id = null;

                    if ($encodestr[$k] == '-') {
                        $id = $encodestr[$k - 1];
                    } else if ($k == strlen($encodestr) - 1) {
                        $id = $encodestr[$k];
                    }
                    if ($id != null) {
                        $temp = payment_time::where('payment_time_id', '=', $id)->get();
                        $time->add($temp->get(0)['time']);
                    }
                }


                if ($time->count() == 0) {
                    $time = payment_time::all();
                    $day->add($day_obj);
                    $times = collect([]);
                    for ($j = 0; $j < $time->count(); $j++) {
                        $times->add($time->get($j)['time']);
                    }

                } else {

                    $day->add($day_obj);
                    $times = collect([]);
                    for ($j = 0; $j < $time->count(); $j++) {
                        $times->add($time->get($j));
                    }

                }


            } else {
                $time = payment_time::all();
                $day->add($day_obj);
                $times = collect([]);
                for ($j = 0; $j < $time->count(); $j++) {
                    $times->add($time->get($j)['time']);
                }

            }


            $final_times = collect([]);
            if ($i == 0) {

                for ($l = 0; $l < $times->count(); $l++) {
                    if ($first_time == 20) {
                        continue;
                    }
                    $time = $times->get($l); // 9-11
                    if (!(strpos($time, '-') !== false)) {
                        if ($time > $first_time) {
                            $final_times->add($times[$l]);
                        }
                    } else {
                        for ($c = 0; $c < strlen($time); $c++) {
                            if ($time[$c] == '-' && substr($time, 0, $c) > $first_time) {
                                $bool = true;
                                $final_times->add($times[$l]);
                            }
                        }
                    }
                }
            } else {
                $final_times = $times;
            }


            if ($final_times->count() > 0) {
                $day->add(array_values($final_times->toArray()));
                $dates->add($day);
            }


        }

        $output->put('dates', $dates);

        return $output;

    }

    public function add_cart(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $result = DB::transaction(function () use ($request, $userid) {
            user_cart::where('user_id', '=', $userid)->delete();

            $jsontext = $request->json_text;
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);
            foreach ($decoded as $key => $value) {
                user_cart::create([
                    'user_id' => $userid,
                    'product_id' => $value->Id,
                    'number' => $value->Tedad,
                ]);
            }
            return "ok";
        });
        return $result;

    }

    public function cart_products(Request $request)
    {
        $userid = G::checkToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkToken($request->token);
        $temp = user_cart::where('user_id', '=', $userid)->get(['product_id', 'number']);
        $final = collect([]);
        for ($i = 0; $i < $temp->count(); $i++) {
            $product = G::getProduct_MinimumData($temp->get($i)['product_id'], ['stock']);
            $product->put('number', $temp->get($i)['number']);
            $final->add($product);
        }
        return $final;
    }
}
