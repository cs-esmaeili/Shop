<?php

namespace App\Http\Controllers;

use App\Models\firstpage;
use App\Models\product;
use App\Models\user_address;
use App\Models\view;
use http\Client\Response;
use Illuminate\Http\Request;
use function Couchbase\defaultDecoder;

class WebController extends Controller
{
    public function firstpage(Request $request)
    {
        $result = firstpage::all();
        $record = $result->map(function ($value, $key) {

            $collect = collect($value);
            if ($value['product_id'] != 0 && $value['product_id'] != "" && $value['product_id'] != "0") {

                $product = G::getProduct_MinimumData($value['product_id'], ['description', 'order_number', 'category', 'stock']);
                if ($product != false) {
                    $product->each(function ($value, $key) use ($collect) {
                        $collect->put($key, $value);
                    });
                    return $collect;
                }
            } else if ($collect['post_image'] != "" && $collect['post_image'] != null) {
                $collect['post_image'] = env('APP_URL') . "images/firstpage/" . $collect['post_image'];
                return $collect;
            }

        });

        $products_talaei = collect([]);
        $products_porforosh = collect([]);
        $products_news = collect([]);
        $slider = collect([]);

        for ($i = 0; $i < $record->count(); $i++) {
            if ($record->get($i)['location'] == 1) {
                $products_talaei->add($record->get($i));
            } else if ($record->get($i)['location'] == 7) {
                $products_porforosh->add($record->get($i));
            } else if ($record->get($i)['location'] == 9) {
                $products_news->add($record->get($i));
            } else if ($record->get($i)['location'] == 10) {
                $slider->add($record->get($i)['post_image']);
            }
        }

//        $roz = (int) trim($timer . substr(strrpos($timer, "-") + 1, strrpos($timer, "-") + 3), " ");
//        $roz = $roz * 24;
//        $saat = $roz + (int) str_replace(":", "", $timer . substr(strrpos($timer, " ") + 1, strrpos($timer, " ") + 3));
//        $daghighe = (int) str_replace(":", "", $timer . substr(strrpos($timer, ":") + 1, strrpos($timer, ":") + 3));
//        $saniye = $timer . (int) substr(strrpos($timer, ":") + 1, strlen($timer));

        $time = product::where('product_id', '=', $products_talaei[0]['product_id'])->get();

        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['page' => "main"]);
        $result = UserController::mainCategory($myRequest);
        $new = collect([]);
        $index = 1;
        for ($i = 0; $i < $result->count(); $i++) {
            for ($j = 0; $j < $result->count(); $j++) {
                if ($result[$j]['category_index'] == $index) {
                    $new->add($result[$j]);
                    $index++;
                }
            }
        }

        return view('web.index', [
            'gold' => $products_talaei,
            'many' => $products_porforosh,
            'new' => $products_news,
            'slider' => $slider,
            'time' => $time->get(0)['datetime'],
            'category' => $new,
        ]);
    }

    public function product(Request $request)
    {
        $product = G::getProduct_MinimumData($request->productid, ['stock'])->toArray();
        $a = scandir(dirname(__DIR__, 4) . "/public_html/images/" . $product['image_folder']);
        $images = array();
        for ($i = 2; $i < sizeof($a); $i++) {
            $images[] = env('APP_URL') . "images/" . $product['image_folder'] . "/" . $a[$i];
        }
        $time = product::where('product_id', '=', $product['product_id'])->get();

        return view('web.product', [
            'time' => $time->get(0)['datetime'],
            'product' => $product,
            'images' => $images,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->has('text') && $request->text != "") {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['text' => $request->text]);
            $myRequest->request->add(['sort' => 'Nothing']);
            $result = UserController::search($myRequest);

            return view('web.search', ['products' => collect()->put('products', $result), 'text' => $request->text]);
        } else {
            return view('web.search');
        }

    }

    public function category(Request $request)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['page' => "main"]);
        $result = UserController::mainCategory($myRequest);
        $new = collect([]);
        $index = 1;
        for ($i = 0; $i < $result->count(); $i++) {
            for ($j = 0; $j < $result->count(); $j++) {
                if ($result[$j]['category_index'] == $index) {
                    $new->add($result[$j]);
                    $index++;
                }
            }
        }
        return view('web.category', ['category' => $new]);
    }

    public function subcategory(Request $request)
    {
        $result = UserController::subCategory($request->main_category_id);
        return view('web.subcategory', ['subcategory' => $result]);
    }

    public function subcategory_product(Request $request)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['value' => $request->product_category]);
        $myRequest->request->add(['sort' => 'Nothing']);
        $myRequest->request->add(['number' => (($request->page_number - 1) * 12)]);
        $result = UserController::productList($myRequest);
        return view('web.list_product', ['products' => $result, 'active' => $request->page_number]);
    }

    public function about_us(Request $request)
    {
        return view('web.aboutus');
    }

    public function rules(Request $request)
    {
        return view('web.rules');
    }

    public function login(Request $request)
    {

        if (session()->has('token')) {
            session()->forget('token');
            session()->forget('card');
            session()->forget('username');
            return redirect(route('web_firstpage'));
        }
        if ($request->has('username') != null && $request->has('password') != null) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['username' => $request->username]);
            $myRequest->request->add(['password' => $request->password]);
            $result = UserAuthentication::login($myRequest);


            $jsontext = $result->content();
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);
            $text = null;
            if ($decoded->status == "wrong")
                $text = "نام کاربری یا رمز عبور اشتباه است";
            else if ($decoded->status == "notexist") {
                $text = "حساب کابری با این مشخصات وجود ندارد";
            } else if ($decoded->status == "ban") {
                $text = "حساب کابری محدود شده است";
            } else if ($decoded->status == "ok") {
                session()->put('token', $decoded->token);
                session()->put('username', $request->username);
                return redirect(route('web_firstpage'));
            }

            return view('web.login', ['text' => $text]);
        } else {
            return view('web.login');
        }

    }

    public function enter_code(Request $request)
    {
        return view('web.entercode');
    }

    public function sign_up(Request $request)
    {
        if ($request->has('code1') != null) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['username' => $request->username]);
            $myRequest->request->add(['token' => ($request->code1 . $request->code2 . $request->code3 . $request->code4 . $request->code5)]);
            $result = UserAuthentication::signupVerify($myRequest);
            $jsontext = $result->content();
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);
            //dd($decoded, ($request->code1 . $request->code2 . $request->code3 . $request->code4 . $request->code5), $request->username);
            if ($decoded->status == "ok") {
                return redirect(route('web_login'));
            } else if ($decoded->status == "expired") {
                return view('web.signup', ['alert' => "کد تایید وارد شده منقضی شده است"]);
            } else {
                return view('web.signup', ['alert' => "کد تایید وارد شده اشتباه است"]);
            }
        } else if ($request->has('username') != null && $request->has('password') != null) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['username' => $request->username]);
            $myRequest->request->add(['password' => $request->password]);
            $result = UserAuthentication::signup($myRequest);

            $jsontext = $result->content();
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);
            $text = null;


            if ($decoded->status == "ok" && array_key_exists('remaining_time', $decoded)) {
                UserAuthentication::signupCodeSender($myRequest);
                return view('web.entercode', ['url' => route('web_sign_up'), 'remaining_time' => $decoded->remaining_time, 'username' => $request->username]);
            } else if ($decoded->status == "ok") {
                UserAuthentication::signupCodeSender($myRequest);
                return view('web.entercode', ['url' => route('web_sign_up'), 'remaining_time' => \Carbon\Carbon::now()->addMinutes(2)->format('Y-m-d H:i:s'), 'username' => $request->username]);
            } else if ($decoded->status == "Account available") {
                return view('web.signup', ['text' => "حساب کاربری وجود دارد"]);
            } else if ($decoded->status == "ban") {
                return view('web.signup', ['text' => "حساب کاربری محدود شده است"]);
            }
        } else {
            return view('web.signup');
        }
    }

    public function reset_password(Request $request)
    {
        if ($request->has('newpass') != null) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['username' => $request->username]);
            $myRequest->request->add(['password' => $request->newpass]);
            $myRequest->request->add(['token' => $request->token]);
            $result = UserAuthentication::resetPasswordAction($myRequest);
            $jsontext = $result->content();
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);
            //  dd($decoded, $request->username, $request->newpass, $request->token);
            if ($decoded->status == "ok") {
                return view('web.login', ['alert' => "رمز عبور شما تغییر کرد"]);
            } else if ($decoded->status == "expired") {
                return view('web.login', ['alert' => "کد تایید وارد شده منقضی شده است"]);
            } else {
                return view('web.login', ['alert' => "مشکلی پیش آمد دوباره سعی کنید"]);
            }
        } else if ($request->has('code1') != null) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['username' => $request->username]);
            $myRequest->request->add(['token' => ($request->code1 . $request->code2 . $request->code3 . $request->code4 . $request->code5)]);
            $result = UserAuthentication::resetPasswordVerify($myRequest);
            $jsontext = $result->content();
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);

            if ($decoded->status == "ok") {
                return view('web.newpass', ['token' => $decoded->token, 'username' => $request->username]);
            } else if ($decoded->status == "expired") {
                return view('web.login', ['alert' => "کد تایید وارد شده منقضی شده است"]);
            } else {
                return view('web.login', ['alert' => "کد تایید وارد شده اشتباه است"]);
            }
        } else if ($request->has('username')) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['username' => $request->username]);
            $result = UserAuthentication::resetPassword($myRequest);
            $jsontext = $result->content();
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);
            $text = null;

            if ($decoded->status == "ok" && array_key_exists('remaining_time', $decoded)) {
                UserAuthentication::resetPasswordCodeSender($myRequest);
                return view('web.entercode', ['url' => route('web_reset_password'), 'remaining_time' => $decoded->remaining_time, 'username' => $request->username]);
            } else if ($decoded->status == "ok") {
                UserAuthentication::resetPasswordCodeSender($myRequest);
                return view('web.entercode', ['url' => route('web_reset_password'), 'remaining_time' => \Carbon\Carbon::now()->addMinutes(2)->format('Y-m-d H:i:s'), 'username' => $request->username]);
            } else if ($decoded->status == "notexist") {
                return view('web.login', ['text' => "حساب کاربری وجود ندارد"]);
            } else if ($decoded->status == "ban") {
                return view('web.login', ['text' => "حساب کاربری محدود شده است"]);
            }

        } else {
            return view('web.resetpassword');
        }

    }

    public function Favorites()
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $myRequest->request->add(['number' => 0]);
        $result = UserController::Favorites($myRequest);
        $final = collect([]);
        $final->put('products', collect([]));
        for ($i = 0; $i < $result->count(); $i++) {
            $final['products']->add($result[$i]->toArray());
        }

        return view('web.favorites', ['products' => $final]);

    }

    public function deleteFavorites(Request $request)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $myRequest->request->add(['product_id' => $request->product_id]);
        $result = UserController::deleteFavorite($myRequest);
        return redirect(route('web_Favorites'));
    }

    public function addFavorites(Request $request)
    {
        if (session()->has('token')) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['token' => session()->get('token')]);
            $myRequest->request->add(['product_id' => $request->product_id]);
            $result = UserController::addFavorite($myRequest);
            return redirect(route('web_Favorites'));
        } else {
            return redirect(route('web_login'));
        }

    }

    public function web_address(Request $request)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $result = UserController::address($myRequest);

        return view('web.list_address', ['address' => $result]);
    }

    public function address_delete(Request $request)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $myRequest->request->add(['user_address_id' => $request->user_address_id]);
        $result = UserController::addressDelete($myRequest);
        return redirect((session()->has('token')) ? route('web_address') : route('web_login'));
    }

    public function address_edit(Request $request)
    {
        if ($request->has('user_address_id') && $request->has('name')) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['token' => session()->get('token')]);
            $myRequest->request->add(['user_address_id' => $request->user_address_id]);
            $myRequest->request->add(['name' => $request->name]);
            $myRequest->request->add(['home_number' => $request->home_number]);
            $myRequest->request->add(['phone_number' => $request->phone_number]);
            $myRequest->request->add(['state' => 'اصفهان']);
            $myRequest->request->add(['city' => 'اصفهان']);
            $myRequest->request->add(['postal_code' => ($request->postal_code == "" || $request->postal_code == null) ? '0' : $request->postal_code]);
            $myRequest->request->add(['address' => $request->address]);
            $result = UserController::addressEdite($myRequest);
            return redirect(route('web_address'));
        } else if ($request->has('user_address_id') == false && $request->has('name')) {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['token' => session()->get('token')]);
            $myRequest->request->add(['user_address_id' => $request->user_address_id]);
            $myRequest->request->add(['name' => $request->name]);
            $myRequest->request->add(['home_number' => $request->home_number]);
            $myRequest->request->add(['phone_number' => $request->phone_number]);
            $myRequest->request->add(['state' => 'اصفهان']);
            $myRequest->request->add(['city' => 'اصفهان']);
            $myRequest->request->add(['postal_code' => ($request->postal_code == "" || $request->postal_code == null) ? '0' : $request->postal_code]);
            $myRequest->request->add(['address' => $request->address]);
            $result = UserController::addressAdd($myRequest);
            return redirect(route('web_address'));
        } else if ($request->has('user_address_id')) {
            $userid = G::checkToken(session()->get('token')) == false ? abort(response("You do not have access", 404)) : G::checkToken(session()->get('token'));
            $result = user_address::where('user_id', '=', $userid)->where('user_address_id', '=', $request->user_address_id)->get();
            return view('web.addressedit', ['data' => $result->get(0)]);
        } else {
            return view('web.addressedit');
        }
    }

    public function add_card(Request $request)
    {
        if (session()->has('card')) {
            $card = session()->get('card');
            $temp = true;
            for ($i = 0; $i < $card->count(); $i++) {
                if ($card[$i]['product_id'] == $request->product_id) {
                    $card[$i]['number'] += 1;
                    $temp = false;
                    break;
                }
            }
            if ($temp) {
                $item = collect([]);
                $item->put('product_id', $request->product_id);
                $item->put('number', 1);
                $card->add($item);
            }
            session()->forget('card');
            session()->put('card', $card);
        } else {
            $card = collect([]);
            $item = collect([]);
            $item->put('product_id', $request->product_id);
            $item->put('number', 1);
            $card->add($item);
            session()->put('card', $card);
        }
        return redirect(route('web_card'));

    }

    public function delete_card(Request $request)
    {
        if (session()->has('card')) {
            $card = session()->get('card');

            for ($i = 0; $i < $card->count(); $i++) {
                if ($card[$i]['product_id'] == $request->product_id) {
                    $card->forget($i);
                    break;
                }
            }
            $new = collect([]);
            foreach ($card as $item) {
                $new->add($item);
            }
            session()->forget('card');
            session()->put('card', $new);
        }

        return redirect(route('web_card'));
    }

    public function card(Request $request)
    {

        if (session()->has('card') == false || (session()->get('card'))->count() == 0) {
            return view('web.card', [
                'images' => null,
                'products' => null,
            ]);
        }
        $card = session()->get('card');

        $products = collect([]);
        $images = array();
        for ($i = 0; $i < $card->count(); $i++) {
            $product = G::getProduct_MinimumData($card[$i]['product_id'], ['stock'])->toArray();
            $a = scandir(dirname(__DIR__, 4) . "/public_html/images/" . $product['image_folder']);

            for ($b = 2; $b < sizeof($a); $b++) {
                $images[] = env('APP_URL') . "images/" . $product['image_folder'] . "/" . $a[$b];
            }
            $product = collect($product);
            $product->put('number', $card[$i]['number']);
            $products->add($product);
        }
        return view('web.card', [
            'images' => $images,
            'products' => $products,
        ]);
    }

    public function payment_step1(Request $request)
    {
        $card = session()->get('card');
        $temp = collect([]);
        for ($i = 0; $i < $card->count(); $i++) {
            $product = G::getProduct_MinimumData($card[$i]['product_id'], ['description', 'order_number', 'category', 'stock']);
            $product->put('number', $card[$i]['number']);
            $temp->add($product);
        }
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $address = UserController::address($myRequest);

        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $time = UserController::peyment_step($myRequest);

        $cour_price = $time['courier_price'];
        $max_price = $time['max_price'];
        $max_price_text = $time['max_price_text'];
        $fast = $time['fast'];
        $times = collect([]);
        for ($i = 0; $i < $time['dates']->count(); $i++) {
            $item = collect([]);
            for ($b = 0; $b < count($time['dates'][$i][1]); $b++) {
                $item->add($time['dates'][$i][0]['date'] . " ساعت: " . $time['dates'][$i][1][$b]);
            }
            $times->add($item);
        }

        $price_whitout_off = 0;
        $off = 0;
        $price_whit_off = 0;
        $price_cour = G::$cour_price;
        $price_final = 0;

        for ($i = 0; $i < $temp->count(); $i++) {
            if ($temp[$i]['old_price'] != 0 || $temp[$i]['old_price'] != null) {
                $price_whitout_off += ($temp[$i]['old_price'] * $temp[$i]['number']);
            } else {
                $price_whitout_off += ($temp[$i]['price'] * $temp[$i]['number']);
            }
            $price_whit_off += ($temp[$i]['price'] * $temp[$i]['number']);
        }

        $off = $price_whitout_off - $price_whit_off;
        if ($price_whit_off > G::$max_price) {
            $price_cour = 0;
        }
        $price_final = $price_whit_off + $price_cour;

        return view('web.payment_step1', [
            'products' => $temp,
            'address' => $address,
            'price_whitout_off' => $price_whitout_off,
            'off' => $off,
            'price_whit_off' => $price_whit_off,
            'price_cour' => ($price_cour == 0) ? "رایگان" : $price_cour,
            'price_final' => $price_final,
            'max_price_text' => $max_price_text,
            'fast' => $fast,
            'times' => $times,
        ]);

    }

    public function payment(Request $request)
    {

        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $address = UserController::address($myRequest);

        $address_id = -1;
        for ($i = 0; $i < $address->count(); $i++) {
            if ($address[$i]['address'] == $request->address) {
                $address_id = $address[$i]['user_address_id'];
                break;
            }
        }
        $card = session()->get('card');
        $temp = collect([]);
        for ($i = 0; $i < $card->count(); $i++) {
            $product = G::getProduct_MinimumData($card[$i]['product_id'], ['description', 'order_number', 'category', 'stock']);
            $product->put('Tedad', $card[$i]['number']);
            $product->put('kalaId', $card[$i]['product_id']);
            $temp->add($product);
        }

        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $myRequest->request->add(['products' => $temp]);
        $myRequest->request->add(['address_id' => $address_id]);
        $myRequest->request->add(['date' => ($request->time_radio == "time") ? str_replace('ساعت:', '', $request->time) : "فوری"]);
        $myRequest->request->add(['payment' => ($request->payment == "online") ? "true" : "false"]);

        return redirect(PaymentController::start($myRequest));
    }

    public function orders(Request $request)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $result = UserController::factor($myRequest);
        return view('web.orders', ['orders' => $result]);
    }

    public function order_information(Request $request)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['token' => session()->get('token')]);
        $myRequest->request->add(['factor_id' => $request->factor_id]);
        $result = UserController::factorInformation($myRequest);
        return view('web.order_information', ['info' => $result->get(0), 'status' => $result->get(0)['status']]);
    }

    public function card_mines(Request $request)
    {
        $card = session()->get('card');
        $temp = true;
        for ($i = 0; $i < $card->count(); $i++) {
            if ($card[$i]['product_id'] == $request->product_id) {
                if ($card[$i]['number'] - 1 > 0) {
                    $card[$i]['number'] -= 1;
                }
                $temp = false;
                break;
            }
        }
        if ($temp) {
            $item = collect([]);
            $item->put('product_id', $request->product_id);
            $item->put('number', 1);
            $card->add($item);
        }
        session()->forget('card');
        session()->put('card', $card);
        return redirect(route('web_card'));
    }

    public function card_plus(Request $request)
    {
        $t = product::where('product_id', '=', $request->product_id)->get();

        $card = session()->get('card');
        $temp = true;
        for ($i = 0; $i < $card->count(); $i++) {
            if ($card[$i]['product_id'] == $request->product_id) {
                if ($card[$i]['number'] + 1 <= $t->get(0)['order_number']) {
                    $card[$i]['number'] += 1;
                }
                $temp = false;
                break;
            }
        }
        if ($temp) {
            $item = collect([]);
            $item->put('product_id', $request->product_id);
            $item->put('number', 1);
            $card->add($item);
        }
        session()->forget('card');
        session()->put('card', $card);

        return redirect(route('web_card'));
    }
}

