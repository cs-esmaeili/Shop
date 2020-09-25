<?php

namespace App\Http\Controllers;

use App\Models\courier;
use App\Models\courier_task;
use App\Models\factor;
use App\Models\factor_product;
use App\Models\factor_status;
use App\Models\product;
use App\Models\warehouse;
use App\Models\warehouse_order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourierController extends Controller
{
    public function CheckEnter(Request $request)
    {
        $result = courier::where('username', '=', $request->username)
            ->where('password', '=', G::getHash($request->password))
            ->get();
        if ($result->count() == 1) {
            return $result->get(0)['token'];
        } else {
            return "fail";
        }

    }

    public function getfactors(Request $request)
    {
        $courier_id = G::checkCourierToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkCourierToken($request->token);


        $result = courier_task::where('courier_task.courier_id', '=', $courier_id)
            ->join('factor', 'courier_task.factor_id', '=', 'factor.factor_id')
            ->where('factor.status', '=', 7)
            ->groupBy('courier_task.factor_id')
            ->get();


        $final = collect([]);
        for ($i = 0; $i < $result->count(); $i++) {
            $row = collect([]);

            $factor = factor::where('factor_id', '=', $result[$i]['factor_id'])->get(['factor_id', 'datetime', 'name', 'phone_number'
                , 'home_number', 'state', 'city', 'postal_code', 'address', 'ref_id', 'total_Price', 'difference_status']);
            $factor = collect($factor->get(0));


            $factor->put('price', "" . G::factor_price($result[$i]['factor_id'], false, false, false));
            $row->add($factor);

            $result2 = courier_task::where('courier_id', '=', $courier_id)
                ->join('factor', 'courier_task.factor_id', '=', 'factor.factor_id')
                ->where('factor.status', '=', 7)
                ->where('courier_task.factor_id', '=', $result[$i]['factor_id'])
                ->groupBy('courier_task.warehouse_id')
                ->get();

            $row[0]->put('warehouses', collect([]));
            for ($j = 0; $j < $result2->count(); $j++) {

                $warehouse = warehouse::where('warehouse_id', '=', $result2[$j]['warehouse_id'])->get(['warehouse_id', 'name', 'warehouse_keeper_name', 'address', 'phonenumber']);
                $row[0]['warehouses']->add(collect($warehouse->get(0)));


                $warehouse_id = collect($warehouse->get(0))['warehouse_id'];

                $temp = courier_task::where('factor_id', '=', $result[$i]['factor_id'])
                    ->where('warehouse_id', '=', $warehouse_id)
                    ->get();

                $row[0]['warehouses'][$j]->put('products', collect([]));

                for ($k = 0; $k < $temp->count(); $k++) {
                    $factor_product_id = collect($temp->get($k))['factor_product_id'];
                    $factor_product = factor_product::where('factor_product_id', '=', $factor_product_id)->get();
                    $product_id = collect($factor_product->get(0))['product_id'];
                    $product = product::where('product_id', '=', $product_id)->get(['product_id', 'name', 'price', 'old_price', 'image_thumbnail', 'weight', 'image_folder']);
                    $product = collect($product->get(0))->replace([
                        'price' => collect($factor_product->get(0))['price'],
                        'old_price' => collect($factor_product->get(0))['old_price'],
                        'weight' => collect($factor_product->get(0))['weight'],
                        'image_thumbnail' => env('APP_URL') . 'images/' . $product->get(0)['image_folder'] . '/' . $product->get(0)['image_thumbnail'],
                    ]);
                    $product->put('number', collect($factor_product->get(0))['number']);
                    $row[0]['warehouses'][$j]['products']->add($product);
                }
            }
            $final->add($row->get(0));
        }

        return $final;

    }

    public function tahvil(Request $request)
    {
        $result = DB::transaction(function () use ($request) {
            $courier_id = G::checkCourierToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkCourierToken($request->token);
            courier_task::where('factor_id', '=', $request->factor_id)
                ->update([
                    'datetime_delivery' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            factor::where('factor_id', '=', $request->factor_id)
                ->update([
                    'status' => 8,
                ]);
            factor_product::where('factor_id', '=', $request->factor_id)->update([
                'status' => 'delivery_done'
            ]);

            $factor = factor::where('factor_id', '=', $request->factor_id)
                ->join('user', 'factor.user_id', '=', 'user.user_id')
                ->get();
            $username = $factor->get(0)['username'];

            $result = null;
            if (G::username_type($username) == "phone_number") {
                // $result = Sms::slow_sms(0, $factor['user_id'], $factor['phone_number'], Sms::$texts['Courier'], ['code' => $request->factor_id]);
                $result = Sms::fast_sms(0, $factor->get(0)['user_id'], G::changeWords($username), '18244', ['code' => $request->factor_id]);
            } else if (G::username_type($username) == "email") {
                $result = Mail::sendMail(0, $factor->get(0)['user_id'], G::changeWords($username), Mail::$texts['Courier'], ['code' => $request->factor_id]);
            }

            if ($result) {
                return 'ok';
            } else {
                return 'fail';
            }

        });
        return $result;
    }

    public function createCourier(Request $request)
    {

        return "disabel";

        $result = courier::create([
            'username' => $request->username,
            'password' => G::getHash($request->password),
            'token' => G::getHash($request->username . Carbon::now()->format('Y-m-d H:i:s')),
            'name' => ' ',
            'family' => ' ',
            'phonenumber' => ' ',
            'plaque' => ' ',
            'level' => 1,
        ]);

        return $result;
    }
}
