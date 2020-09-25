<?php

namespace App\Http\Controllers;

use App\Models\factor;
use App\Models\factor_product;
use App\Models\product;
use App\Models\warehouse_order;
use DateTime;
use Illuminate\Support\Facades\DB;

class G
{

    public static $cour_price = 5000;
    public static $max_price = 75000;
    public static $main_admin = 1;

    public static function changeWords($str)
    {

        $str = strtolower($str);

        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $num = range(0, 9);
        $englishNumbersOnly = str_replace($persian, $num, $str);
        return $englishNumbersOnly;
    }

    public static function checkToken($token)
    {
        $result = DB::table('user')
            ->where('token', '=', $token)
            ->get(['user_id']);
        if ($result->count() > 0 && !$result->isEmpty() && $result->get(0)->user_id != 0) {
            return $result->get(0)->user_id;
        } else {
            return false;
        }
    }

    public static function checkAdminToken($token)
    {
        $result = DB::table('admin')
            ->where('token', '=', $token)
            ->get(['admin_id']);
        if ($result->count() > 0 && !$result->isEmpty() && $result->get(0)->admin_id != 0) {
            return $result->get(0)->admin_id;
        } else {
            return false;
        }
    }

    public static function checkCourierToken($token)
    {
        $result = DB::table('courier')
            ->where('token', '=', $token)
            ->get(['courier_id']);
        if ($result->count() > 0 && !$result->isEmpty() && $result->get(0)->courier_id != 0) {
            return $result->get(0)->courier_id;
        } else {
            return false;
        }
    }

    public static function checkWarehouseToken($token)
    {
        $result = DB::table('warehouse')
            ->where('token', '=', $token)
            ->get(['warehouse_id']);
        if ($result->count() > 0 && !$result->isEmpty() && $result->get(0)->warehouse_id != 0) {
            return $result->get(0)->warehouse_id;
        } else {
            return false;
        }
    }

    public static function getHash($str)
    {
        $saltstr = env('APP_URL') . '###JavadEsmaeili###'; //APP_URL = https://www.cheemarket.com
        $encrypt = sha1(sha1($str . $saltstr) . md5($saltstr . $str) . sha1($saltstr . $str . $str . $saltstr));

        return $encrypt;
    }

    public static function getProduct_MinimumData($productId, $ban)
    {
        $result = product::find($productId);
        $result = self::doProductRule($result);


        if ($result == false) {
            return false;
        }

        $result->forget($ban);
        $result = $result->toArray();

        return collect($result);
    }

    public static function doProductRule($product)
    {
        $product['image_thumbnail'] = env('APP_URL') . "images/" . $product['image_folder'] . "/" . $product['image_thumbnail'];
        if (empty($product['name'])) {
            return false;
        }

        if ($product['price'] < 1000) {
            return false;
        }

        if ($product['old_price'] > 0) {
            if ($product['old_price'] < 1000) {
                return false;
            }

            if ($product['price'] >= $product['old_price']) {
                return false;
            }
        }


        if ($product['order_number'] == 0) {
            return false;
        }


        if (empty($product['image_thumbnail']) || strpos($product['image_thumbnail'], '.') == false) {
            return false;
        }
        if (empty($product['image_folder'])) {
            return false;
        }

        if ($product['stock'] <= 0) {
            $product['status'] = 3;
            $product['order_number'] = 0;
            $product['datetime'] = "0000-00-00 00:00:00";
            return collect($product);
        }

        if ($product['order_number'] > $product['stock']) {
            $product['order_number'] = $product['stock'];
        }
        if (empty($product['category'])) {
            return false;
        }
        if ($product['status'] == 5) {
            return false;
        }

        if ($product['status'] == 6) {
            return false;
        }

        if ($product['status'] == 7) {
            return false;
        }
        if ($product['status'] == 8) {
            return false;
        }
        if ($product['status'] == 2) {
            if ($product['datetime'] == "0000-00-00 00:00:00") {
                $product['status'] = "1";
            }
        } else {
            $product['datetime'] = "0000-00-00 00:00:00";
        }

        if ($product['special_price'] > 0) {
            if ($product['special_price'] < 1000) {
                return false;
            }

            if ($product['special_price'] >= $product['price'] && $product['status'] == "2") {
                return false;
            }

            if ($product['special_price'] >= $product['old_price'] && $product['old_price'] > 0 && $product['status'] == "2") {
                return false;
            }

        }

        if ($product['status'] == 2 && $product['datetime'] != "0000-00-00 00:00:00" && $product['special_price'] >= 1000 && $product['special_price'] < $product['price']) {
            $now = new DateTime(date('Y-m-d H:i:s'));
            $productTime = new DateTime($product['datetime']);
            if ($productTime > $now) {
                $interval = $productTime->diff($now);
                $elapsed = $interval->format('%y-%m-%a %h:%i:%s');

                $product['price'] = $product['special_price'];
                $product['datetime'] = $elapsed;

            } else {
                $product['datetime'] = "0000-00-00 00:00:00";
                $product['status'] = "1";
            }

        }

        return collect($product);
    }

    public static function factor_price($factor_id, $whole, $price_weight, $stop_loop)
    {
        $factor = factor::where('factor_id', '=', $factor_id)->get();
        $factor_price = 0;
        $weight_price = 0;

        for ($i = 0; $i < $factor->count(); $i++) {
            $factor_products = factor_product::where('factor_id', '=', $factor_id)->get();
            for ($j = 0; $j < $factor_products->count(); $j++) {

                $warehouse_order = warehouse_order::where('factor_product_id', '=', $factor_products->get($j)['factor_product_id'])->get();
                $weight = 0;
                for ($k = 0; $k < $warehouse_order->count(); $k++) {
                    $weight += $warehouse_order->get($k)['weight_change'];
                }

                if ($whole) {
                    $factor_price += ($factor_products->get($j)['price'] * $factor_products->get($j)['number']);
                    if ($weight > 0 && $factor_products->get($j)['weight'] > 0)
                        $weight_price += (($weight * $factor_products->get($j)['price']) / $factor_products->get($j)['weight']);
                } else {
                    if ($factor_products->get($j)['payment'] == 'no') {
                        $factor_price += ($factor_products->get($j)['price'] * $factor_products->get($j)['number']);
                    }
                    if ($factor_products->get($j)['payment_weight_change'] == 'no') {
                        if ($weight > 0 && $factor_products->get($j)['weight'] > 0)
                            $weight_price += (($weight * $factor_products->get($j)['price']) / $factor_products->get($j)['weight']);
                    }
                }
            }
        }
        if ($price_weight) {
            return $weight_price;
        }
        if ($stop_loop) {
            return $factor_price;
        }
        $final = $factor_price + $weight_price;
        if (G::factor_price($factor_id, true, false, true) < G::$max_price) {
            $final += G::$cour_price;
        }

        return $final;
    }

    public static $prices = [
        "price_product" => "price_product",
        "price_product_off" => "price_product_off",
        "off" => "off",
        "price_weight" => "price_weight",
        "price_courier" => "price_courier",
        "remain" => "remain",
        "whole" => "whole",
    ];

    public static function price($factor_id, $prices)
    {
        $factor_products = factor_product::where('factor_id', '=', $factor_id)->get();
        $price_weight = 0;
        $price_product = 0;
        $price_product_off = 0;
        $off = 0;
        $price_courier = 0;

        if (in_array("off", $prices)) {
            $prices[] = "whole";
        }else if (in_array("price_courier", $prices)) {
            $prices[] = "whole";
        }

        for ($j = 0; $j < $factor_products->count(); $j++) {

            if (in_array("price_weight", $prices)) {
                if ((in_array("whole", $prices) == false) && (in_array("remain", $prices) == false)) {
                    return "error";
                }
                $warehouse_order = warehouse_order::where('factor_product_id', '=', $factor_products->get($j)['factor_product_id'])->get();
                $weight = 0;
                for ($k = 0; $k < $warehouse_order->count(); $k++) {
                    $weight += $warehouse_order->get($k)['weight_change'];
                }
                if (in_array("remain", $prices) && $factor_products->get($j)['payment_weight_change'] == 'no') {
                    if ($weight != 0 && $factor_products->get($j)['weight'] > 0) {
                        $price_weight += (($weight * $factor_products->get($j)['price']) / $factor_products->get($j)['weight']);
                    }
                } else if (in_array("whole", $prices)) {
                    if ($weight != 0 && $factor_products->get($j)['weight'] > 0) {
                        $price_weight += (($weight * $factor_products->get($j)['price']) / $factor_products->get($j)['weight']);
                    }
                }
            }
            ///////////////////////////////////////////////////
            if (in_array("price_product", $prices) || in_array("off", $prices) || in_array("price_courier", $prices)) {
                if ((in_array("whole", $prices) == false) && (in_array("remain", $prices) == false)) {
                    return "error";
                }
                if (in_array("remain", $prices) && $factor_products->get($j)['payment'] == 'no') {
                    $price_product += ($factor_products->get($j)['price'] * $factor_products->get($j)['number']);
                } else if (in_array("whole", $prices)) {
                    $price_product += ($factor_products->get($j)['price'] * $factor_products->get($j)['number']);
                }
            }
            ///////////////////////////////////////////////////
            if (in_array("price_product_off", $prices) || in_array("off", $prices)) {
                if ((in_array("whole", $prices) == false) && (in_array("remain", $prices) == false)) {
                    return "error";
                }
                if (in_array("remain", $prices) && $factor_products->get($j)['payment_weight_change'] == 'no') {
                    if ($factor_products->get($j)['old_price'] > 0) {
                        $price_product_off += ($factor_products->get($j)['old_price'] * $factor_products->get($j)['number']);
                    } else {
                        $price_product_off += ($factor_products->get($j)['price'] * $factor_products->get($j)['number']);
                    }
                } else if (in_array("whole", $prices)) {
                    if ($factor_products->get($j)['old_price'] > 0) {
                        $price_product_off += ($factor_products->get($j)['old_price'] * $factor_products->get($j)['number']);
                    } else {
                        $price_product_off += ($factor_products->get($j)['price'] * $factor_products->get($j)['number']);
                    }
                }
            }
        }
        ///////////////////////////////////////////////////
        if (in_array("off", $prices)) {
            $off = ($price_product_off - $price_product);
        }

        if (in_array("price_courier", $prices)) {
            if ($price_product < G::$max_price) {
                $price_courier = G::$cour_price;
            }
        }
        $output = collect([]);
        if (in_array("price_product", $prices)) {
            $output->put('price_product', $price_product);
        }
        if (in_array("price_product_off", $prices)) {
            $output->put('price_product_off', $price_product_off);
        }
        if (in_array("off", $prices)) {
            $output->put('off', $off);
        }
        if (in_array("price_weight", $prices)) {
            $output->put('price_weight', $price_weight);
        }
        if (in_array("price_courier", $prices)) {
            $output->put('price_courier', $price_courier);
        }
        return $output;

    }

    public static function username_type($username)
    {
        if (is_int((int)G::changeWords($username)) && (strpos(G::changeWords($username), '09') !== false) && strlen(G::changeWords($username)) == 11) {
            return 'phone_number';
        } else if ((strpos(G::changeWords($username), '@gmail.com') !== false) || (strpos(G::changeWords($username), '@yahoo.com') !== false)) {
            return 'email';
        }
    }
}
