<?php

namespace App\Http\Controllers;

use App\Models\courier;
use App\Models\courier_task;
use App\Models\factor;
use App\Models\factor_product;
use App\Models\factor_status;
use App\Models\product;
use App\Models\reference_code;
use App\Models\warehouse;
use App\Models\warehouse_order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    public function CheckEnter(Request $request)
    {
        $result = warehouse::where('username', '=', $request->username)
            ->where('password', '=', G::getHash($request->password))
            ->get();
        if ($result->count() == 1) {
            return $result->get(0)['token'];
        } else {
            return "fail";
        }

    }

    public function Getorder(Request $request)
    {
        $warehouse_id = G::checkWarehouseToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkWarehouseToken($request->token);
        $location = 'warehouse';
        $factors = warehouse_order::where('warehouse_order.warehouse_id', '=', $warehouse_id)
            ->where('warehouse_order.status', '=', $location)
            ->groupBy('warehouse_order.factor_id')
            ->join('factor', 'warehouse_order.factor_id', '=', 'factor.factor_id')
            ->join('factor_product', 'factor.factor_id', '=', 'factor_product.factor_id')
            ->select(['*', 'factor.status AS factor_status'])
            ->get();

        $output = collect([]);
        for ($i = 0; $i < $factors->count(); $i++) {
            $factor = collect([]);
            $factor->put('factor_id', $factors[$i]['factor_id']);
            $factor->put('factor_status', $factors[$i]['factor_status']);

            if ($factors[$i]['factor_status'] == 7) {
                $courier = courier_task::where('factor_id', '=', $factors[$i]['factor_id'])
                    ->where('warehouse_id', '=', $warehouse_id)
                    ->join('courier', 'courier_task.courier_id', '=', 'courier.courier_id')
                    ->select(['courier.courier_id', 'courier.name', 'courier.family', 'courier.plaque'])
                    ->get();
                $factor->put('courier', $courier->get(0));
            }

            $factor_products = warehouse_order::where('warehouse_order.warehouse_id', '=', $warehouse_id)
                ->where('warehouse_order.factor_id', '=', $factors[$i]['factor_id'])
                ->where('warehouse_order.status', '=', $location)
                ->join('factor_product', 'warehouse_order.factor_product_id', '=', 'factor_product.factor_product_id')
                ->join('product', 'factor_product.product_id', '=', 'product.product_id')
                ->select([
                    'factor_product.factor_product_id',
                    'product.product_id',
                    'factor_product.status',
                    'product.name',
                    'product.atcw',
                    'weight_change',
                    'weight_change_description',
                    'warehouse_order.number',
                    'warehouse_order.warehouse_order_id'
                ])->get();
            $factor->put('products', $factor_products);
            $output->add($factor);
        }
        return $output;
    }

    public function send_admin(Request $request)
    {
        $result = DB::transaction(function () use ($request) {
            $warehouse_id = G::checkWarehouseToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkWarehouseToken($request->token);

            $decoded = json_decode(str_replace("\\", "", $request->jsontext));
            for ($i = 0; $i < count($decoded); $i++) {
                $factor_product_id = $decoded[$i]->factor_product_id . "";
                $weight_change = $decoded[$i]->weight_change . "";
                $weight_change_description = $decoded[$i]->weight_change_description . "";
                $warehouse_order_id = $decoded[$i]->warehouse_order_id . "";
                $all_orders = warehouse_order::where('factor_product_id', '=', $factor_product_id)
                    ->where('status', '=', 'warehouse')
                    ->get();

                if (!($all_orders->count() > 1)) {
                    factor_product::where('factor_product_id', '=', $factor_product_id)
                        ->update([
                            'status' => 'admin',
                        ]);
                }

                warehouse_order::where('warehouse_order_id', '=', $warehouse_order_id)
                    ->where('factor_product_id', '=', $factor_product_id)
                    ->where('warehouse_id', '=', $warehouse_id)
                    ->update([
                        'weight_change' => $weight_change,
                        'weight_change_description' => $weight_change_description,
                        'status' => 'admin',
                    ]);
            }

            $all = factor_product::where('factor_id', '=', $request->factor_id)->where('status', '=', 'warehouse')->get();
            if (!($all->count() > 0)) {
                factor::where('factor_id', '=', $request->factor_id)
                    ->update(['status' => 3]);
            }

            return "ok";
        });
        return $result;
    }

    public function tahvil(Request $request)
    {

        $warehouse_id = G::checkWarehouseToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkWarehouseToken($request->token);
        $temp = warehouse_order::where('warehouse_order.warehouse_id', '=', $warehouse_id)
            ->where('warehouse_order.factor_id', '=', $request->factor_id)
            ->join('factor_product', 'warehouse_order.factor_product_id', '=', 'factor_product.factor_product_id')
            ->join('courier_task', 'warehouse_order.factor_product_id', '=', 'courier_task.factor_product_id')
            ->update([
                'warehouse_order.status' => 'admin',
                'factor_product.status' => 'delivery_time',
                'courier_task.datetime_receive' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        if ($temp > 0) {
            return "ok";
        } else {
            return "error";
        }


    }

    public function createWarehouse(Request $request)
    {
        // dd(G::getHash($request->password) , G::getHash($request->username . Carbon::now()->format('Y-m-d H:i:s')));
        return;
        $result = warehouse::create([
            'username' => $request->username,
            'password' => G::getHash($request->password),
            'token' => G::getHash($request->username . Carbon::now()->format('Y-m-d H:i:s')),
            'name' => '',
            'warehouse_keeper_name' => '',
            'address' => '',
            'phonenumber' => '',
        ]);
        return $result;
    }
}
