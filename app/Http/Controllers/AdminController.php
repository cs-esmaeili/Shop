<?php

namespace App\Http\Controllers;

use App\Http\Controllers\tcpdf\TCPDF;
use App\Models\admin;
use App\Models\admin_journal;
use App\Models\card_information;
use App\Models\courier;
use App\Models\courier_task;
use App\Models\factor;
use App\Models\factor_edite;
use App\Models\factor_product;
use App\Models\factor_status;
use App\Models\log_admin;
use App\Models\product;
use App\Models\sub_category;
use App\Models\warehouse;
use App\Models\warehouse_capacity;
use App\Models\warehouse_order;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        $result = admin::where('username', '=', $request->username)
            ->where('password', '=', G::getHash($request->password))
            ->get();


        if ($result->count() == 1 && $result->get(0)['enabel'] == 'yes' /*&& $result->get(0)['online'] == 'no'*/) {

            admin::where('admin_id', '=', $result->get(0)['admin_id'])
                ->update(['online' => 'yes']);
            log_admin::create([
                'admin_id' => $result->get(0)['admin_id'],
                'description' => "وارد نرم افزار شد",
            ]);
            return $result->get(0)['token'];

        } else if ($result->count() == 1 && $result->get(0)['enabel'] == 'no') {
            return "disable";
        } else if ($result->count() == 1 && $result->get(0)['online'] == 'yes') {
            return "online";
        } else {
            return "fail";
        }

    }

    public function ordercomestart(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);


        $result = admin::where('token', '=', $request->token)
            ->update([
                'order_come' => 'yes',
            ]);

        if ($result == 1) {

            factor::where('admin_id', '=', G::$main_admin)->update([
                'admin_id' => $adminid
            ]);
            $result = admin::where('token', '=', $request->token)->get();
            log_admin::create([
                'admin_id' => $result->get(0)['admin_id'],
                'description' => "اعلان برای دریافت سفارش کرد",
            ]);
            return "ok";
        } else {
            return "fail";
        }

    }

    public function Getorder(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = factor::where('admin_id', '=', $adminid)->where('status', '=', 1)->get();
        return $result;
    }

    public function Getorder_back(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = factor::where('admin_id', '=', $adminid)->where('status', '=', 2)->orwhere('status', '=', 3)
            ->orwhere('status', '=', 4)
            ->orwhere('status', '=', 5)
            ->orwhere('status', '=', 6)
            ->get();


        return $result;
    }

    public function getproducts(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = factor_product::where('factor_id', '=', $request->factor_id)->get();
        for ($i = 0; $i < $result->count(); $i++) {
            $temp = product::where('product_id', '=', $result[$i]['product_id'])->get();
            $value = collect($result[$i]);
            $value->put('product_name', $temp->get(0)['name']);
            $result[$i] = $value;

        }
        return $result;
    }

    public function get_products_back(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = factor_product::where('factor_id', '=', $request->factor_id)->get();


        $result = DB::table('factor_product')
            ->where('factor_product.factor_id', '=', $request->factor_id)
            ->join('warehouse_order', 'factor_product.factor_product_id', '=', 'warehouse_order.factor_product_id')
            ->join('warehouse', 'warehouse_order.warehouse_id', '=', 'warehouse.warehouse_id')
            ->join('product', 'factor_product.product_id', '=', 'product.product_id')
            ->join('factor', 'factor_product.factor_id', '=', 'factor.factor_id')
            ->select([
                'factor_product.factor_product_id', 'factor_product.status AS factor_product_status', 'factor.total_Price', 'factor_product.factor_id', 'factor_product.product_id', 'warehouse_order.number', 'factor_product.price'
                , 'factor_product.old_price', 'factor_product.weight', 'product.name AS product_name', 'factor_product.payment'
                , 'factor_product.payment_weight_change', 'warehouse_order.weight_change', 'warehouse_order.weight_change_description', 'warehouse.name AS warehouse_name'
                , 'warehouse.warehouse_keeper_name', 'warehouse.address', 'warehouse_order.status AS warehouse_order_status'
                , 'warehouse.phonenumber', 'warehouse.warehouse_id', 'warehouse_order.warehouse_order_id'
            ])->get();

        return $result;
    }

    public function Listanbarha(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = warehouse_capacity::where('product_id', '=', $request->product_id)->where('number', '>', 0)->get();
        $record = collect([]);
        for ($i = 0; $i < $result->count(); $i++) {
            $temp = warehouse::where('warehouse_id', '=', $result[$i]['warehouse_id'])->get();
            $temp = $temp->get(0);
            $temp = collect($temp);
            $temp->forget(['username', 'password', 'token']);
            $temp->put('number', $result[$i]['number']);
            $record->push($temp);
        }
        return $record;
    }

    public function rezef(Request $request)
    {
        $result = DB::transaction(function () use ($request) {
            $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
            $result = warehouse_capacity::where('product_id', '=', $request->product_id)->where('warehouse_id', '=', $request->warehouse_id)->get();
            $result = $result->get(0);


            if ($result['number'] < $request->number) {
                return "fail";
            }
            $result = warehouse_capacity::where('product_id', '=', $request->product_id)
                ->where('warehouse_id', '=', $request->warehouse_id)
                ->update([
                    'number' => ($result['number'] - $request->number)
                ]);

            $result = admin_journal::create([
                'admin_id' => $adminid,
                'factor_id' => $request->factor_id,
                'factor_product_id' => $request->factor_product_id,
                'warehouse_id' => $request->warehouse_id,
                'product_id' => $request->product_id,
                'number' => $request->number,
            ]);

            if ($result->wasRecentlyCreated) {
                return "ok";
            } else {
                return "fail";
            }
        });
        return $result;

    }

    public function returnrezerf(Request $request)
    {

        $result = DB::transaction(function () use ($request) {
            $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);


            $result = warehouse_capacity::where('product_id', '=', $request->product_id)
                ->where('warehouse_id', '=', $request->warehouse_id)
                ->get();
            $result = $result->get(0);
            $result = warehouse_capacity::where('product_id', '=', $request->product_id)
                ->where('warehouse_id', '=', $request->warehouse_id)
                ->update([
                    'number' => ($result['number'] + $request->number)
                ]);


            $result = admin_journal::where('product_id', '=', $request->product_id)
                ->where('warehouse_id', '=', $request->warehouse_id)
                ->where('admin_id', '=', $adminid)
                ->where('factor_id', '=', $request->factor_id)
                ->where('factor_product_id', '=', $request->factor_product_id)
                ->delete();


            if ($result > 0) {
                return "ok";
            } else {
                return "fail";
            }
        });
        return $result;
    }

    public function GetCouriers(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        return courier::all();
    }

    public function Send_To_warehouse(Request $request)
    {
        $result = DB::transaction(function () use ($request) {
            $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
            $jsontext = $request->jsontext;
            $jsontext = str_replace("\\", "", $jsontext);
            $decoded = json_decode($jsontext);
            for ($i = 0; $i < count($decoded); $i++) {
                $anbarid = $decoded[$i]->anbarid . "";
                $orderid = $decoded[$i]->factor_product_id . "";
                $Category = $decoded[$i]->factor_id . "";
                $tedadarjashode = $decoded[$i]->tedadarjashode . "";

                warehouse_order::create([
                    'warehouse_id' => $anbarid,
                    'factor_id' => $Category,
                    'factor_product_id' => $orderid,
                    'number' => $tedadarjashode,
                    'weight_change' => 0,
                    'weight_change_description' => "",
                    'status' => 'warehouse'
                ]);
            }
            $Category = $decoded[0]->factor_id . "";

            $temp = admin_journal::where('factor_id', '=', $Category)->delete();
            if (!$temp) {
                return false;
            }

            $temp = factor::where('factor_id', '=', $Category)->update(['status' => 2]);
            if ($temp != 1) {
                return false;
            }

            $temp = factor_product::where('factor_id', '=', $Category)->update(['status' => 'warehouse']);
            if ($temp == 0) {
                return false;
            }

            return "ok";

        });
        return ($result == false) ? "error" : $result;

    }

    public function pdf(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $factor_products = factor_product::where('factor_id', '=', $request->factor_id)->get();

        $sum_price = G::price($request->factor_id, ['price_product', 'whole'])['price_product'];
        $sum_oldprice = G::price($request->factor_id, ['price_product_off', 'whole'])['price_product_off'];
        $sum_weight_change = G::price($request->factor_id, ['price_weight', 'whole'])['price_weight'];
        $cour_price = G::price($request->factor_id, ['price_courier'])['price_courier'];

        for ($j = 0; $j < $factor_products->count(); $j++) {
            $result = product::where('product_id', '=', $factor_products[$j]->product_id)->get();
            $factor_products->get($j)['name'] = $result[0]['name'];
            $warehouse_order = warehouse_order::where('factor_product_id', '=', $factor_products->get($j)['factor_product_id'])->get();
            $weight = 0;
            for ($k = 0; $k < $warehouse_order->count(); $k++) {
                $weight += $warehouse_order->get($k)['weight_change'];
            }
            $factor_products->get($j)['weight_change'] = $weight;
        }
        $temp = factor::where('factor_id', '=', $request->factor_id)->get();
        $time = Carbon::createFromFormat('Y-m-d H:i:s', $temp->get(0)['created_at'])->format('Y-m-d H:i:s');
        $date = jdf::convert($time, true);


        $content = '<table  border="1" cellspacing="0" cellpadding="3" >
     <tr>
           <th align="center" colspan="6">چی مارکت</th>
     </tr>
     <tr >
	  <th   colspan="3" align="right" >کد سفارش</th>
	  <th  colspan="4" align="left" >' . $request->factor_id . '</th>
     </tr>
     <tr >
	  <th   colspan="3" align="right" >شماره تماس</th>
	  <th  colspan="4" align="left" >031-32290573</th>
     </tr>
	 <tr>
	   <th  colspan="3" align="right" >آدرس وب سایت</th>
	   <th  colspan="4" align="left" >www.cheemarket.com</th>
     </tr>

	 <tr>
	  <th  colspan="3" align="right" >زمان خرید</th>
	  <th  colspan="4" align="left" > ' . $date . '</th>
     </tr>

     <tr>
           <th>نام کالا</th>
           <th>تعداد/کیلو</th>
           <th>تغییرات وزن</th>
           <th>قیمت</th>
           <th>قیمت با تخفیف</th>
           <th>جمع کل</th>
     </tr>';

        for ($i = 0; $i < $factor_products->count(); $i++) {
            $content .= '<tr>
           <td align="right">' . $factor_products[$i]['name'] . '</td>
           <td align="center" >' . $factor_products[$i]['number'] . '</td>
           <td align="center">' . $factor_products[$i]['weight_change'] . '</td>
           <td align="center">' . $factor_products[$i]['old_price'] . '</td>
           <td align="center">' . $factor_products[$i]['price'] . '</td>
           <td align="center">' . ($factor_products[$i]['price'] * $factor_products[$i]['number']) . '</td>
          </tr>';
        }
        $content .= '<tr>
            <th colspan="3" align="right" >قیمت بدون تخفیف</th>
            <th colspan="4" align="left" >' . ($sum_oldprice) . '</th>
     </tr>
	  <tr>
	    <th   colspan="3" align="right" >تخفیف</th>
		<th   colspan="4" align="left" >' . ($sum_oldprice - $sum_price) . '</th>
     </tr>

     <tr>
	    <th   colspan="3" align="right" >قیمت با تخفیف</th>
		<th   colspan="4" align="left" >' . ($sum_price) . '</th>
     </tr>

	  <tr>
	    <th   colspan="3" align="right" >قیمت تغییرات وزن</th>
		<th   colspan="4" align="left" >' . ($sum_weight_change) . '</th>
     </tr>

	 <tr>
	     <th   colspan="3" align="right" >هزینه پیک </th>
		 <th colspan="4" align="left" >' . ($cour_price) . '</th>
     </tr>

	 <tr>
	   <th  colspan="3" align="right" >قیمت نهایی</th>
	   <th colspan="4" align="left" >' . ($sum_price + $sum_weight_change + $cour_price) . '</th>
     </tr>

</table>';


        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';

        require_once('tcpdf/examples/tcpdf_include.php');
        require_once('tcpdf/tcpdf.php');
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $width = 72;
        $height = $obj_pdf->getStringHeight($width, $content, false, true) + 10;
        $pageLayout = array($width, $height);
        $obj_pdf = new TCPDF('P', PDF_UNIT, $pageLayout, true, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
        $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        //$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(0, 0, 0/*PDF_MARGIN_RIGHT*/);
        /// $obj_pdf->SetMargins(1,1,1, true);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        // $obj_pdf->SetAutoPageBreak(TRUE, 10);

        if (@file_exists(dirname(__FILE__) . 'tcpdf/examples/lang/far.php')) {
            require_once(dirname(__FILE__) . 'tcpdf/examples/lang/far.php');
            $obj_pdf->setLanguageArray($lg);
        }
        $obj_pdf->setRTL(true);
        $obj_pdf->setFontSubsetting(true);
        $obj_pdf->SetFont('dejavusans', '', 7, '', true);
        $obj_pdf->AddPage();
        $obj_pdf->writeHTML($content);
        $obj_pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/pdf/' . $request->factor_id . '.pdf', 'F');
        return env('APP_URL') . 'pdf/' . $request->factor_id . '.pdf';
    }

    public function Getorderdetails(Request $request)
    {

        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $factor = factor::where('factor_id', '=', $request->factor_id)->get();
        $factor = collect($factor->get(0));

        $products = factor_product::where('factor_id', '=', $request->factor_id)->get();

        $sum_price = 0;
        for ($j = 0; $j < $products->count(); $j++) {

            $resultt = product::where('product_id', '=', $products[$j]->product_id)->get();
            $resultt = collect($resultt[0]);
            $resultt->forget(['stock', 'old_price', 'image_thumbnail', 'datetime', 'status', 'category', 'description', 'order_number', 'product_id']);
            $resultt = $resultt->replace([
                'price' => $products[$j]->price,
            ]);
            $sum_price += ($products[$j]->price * $products[$j]->number);
        }
        $factor->put('price', $sum_price);
        $time = $time = Carbon::createFromFormat('Y-m-d H:i:s', $factor->toArray()['created_at'])->format('Y-m-d H:i:s');
        $factor = $factor->replace(['created_at' => jdf::convert($time, true), true]);

        return $factor;
    }

    public function returnallrezerf(Request $request)
    {

        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = DB::transaction(function () use ($request, $adminid) {


            $result = admin_journal::where('admin_id', '=', $adminid)->get();
            $result = $result->map(function ($value, $key) {

                $result = warehouse_capacity::where('product_id', '=', $value['product_id'])->get();
                $result = $result->get(0);

                $result = warehouse_capacity::where('product_id', '=', $value['product_id'])
                    ->where('warehouse_id', '=', $value['warehouse_id'])
                    ->update([
                        'number' => ($result['number'] + $value['number'])
                    ]);


            });

            admin::where('admin_id', '=', $adminid)->update(['order_come' => 'no', 'online' => 'no']);
            log_admin::create([
                'admin_id' => $adminid,
                'description' => "از برنامه خارج شد",
            ]);


            $result = admin_journal::where('admin_id', '=', $adminid)->delete();


            if ($result >= 1) {
                return "ok";
            } else if ($result == 0) {
                return "ok";
            } else {
                return "fail";
            }

        });
        return $result;
    }

    public function searchkala(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = product::all();
        $result = collect($result);
        for ($i = 0; $i < $result->count(); $i++) {
            $result[$i] = collect($result[$i]);
            $result[$i] = $result[$i]->replace(['image_thumbnail' => (env('APP_URL') . 'images/' . $result[$i]['image_folder'] . '/' . $result[$i]['image_thumbnail'])]);
        }
        return $result;
    }

    public function savekaladata(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);

        $product = product::where('product_id', '=', $request->Id)->get();


        $result = product::where('product_id', '=', $request->Id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'status' => $request->status,
                'category' => $request->category,
                'stock' => $request->stock,
                'order_number' => $request->order_number,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'weight' => $request->weight,
                'atcw' => $request->atcw
            ]);


        log_admin::create([
            'admin_id' => $adminid,
            'description' => "[
                        'name' => " . $product->get(0)['name'] . ",
                        'price' => " . $product->get(0)['price'] . ",
                        'old_price' =>  " . $product->get(0)['old_price'] . ",
                        'status' =>  " . $product->get(0)['status'] . ",
                        'category' =>  " . $product->get(0)['category'] . ",
                        'stock' =>  " . $product->get(0)['stock'] . ",
                        'order_number' =>   " . $product->get(0)['order_number'] . " ,
                        'barcode' =>   " . $product->get(0)['barcode'] . ",
                        'description' =>  " . $product->get(0)['description'] . ",
                        'weight' =>   " . $product->get(0)['weight'] . " ,
                         'atcw' =>   " . $product->get(0)['atcw'] . " ,
                    " . "\n" . ']' . "\n[
                    'name' => $request->name,
                    'price' => $request->price,
                    'old_price' => $request->old_price,
                    'status' => $request->status,
                    'category' => $request->category,
                    'stock' => $request->stock,
                    'order_number' => $request->order_number,
                    'barcode' => $request->barcode,
                    'description' => $request->description,
                    'weight' => $request->weight,
                      'atcw' => $request->atcw
                " . "\n" . "]",
        ]);


        if ($result == 1) {
            return "ok";
        } else {
            return "fail";
        }
    }

    public function deleteintoimage(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        if (!unlink(dirname(__DIR__, 4) . "/public_html/images/" . $request->Foldername . '/' . $request->Imagename)) {
            echo("Error deleting");
        } else {
            echo("Deleted");
        }
    }

    public function setspeacial(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = product::where('product_id', '=', $request->kalaid)->get();
        $result = $result->get(0);

        if ($request->price >= $result['price'] || $request->price < 1000) {
            return "pricefail";
        }
        $alan = date('Y-m-d H:i:s');
        $datetime1 = new DateTime($alan);
        $datetime2 = new DateTime($request->time);

        if ($datetime2 <= $datetime1) {
            return "timefial";
        }

        product::where('product_id', '=', $request->kalaid)
            ->update([
                'datetime' => $request->time,
                'special_price' => $request->price,
                'status' => 2,
            ]);

        log_admin::create([
            'admin_id' => $adminid,
            'description' => "product_id=" . $request->kalaid . "\n [
                    'datetime' => $request->time,
                    'special_price' => $request->price,
                    'status' => 2,
                ] ",
        ]);
        return "ok";

    }

    public function uploadintoimage(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $Foldername = "";
        $time = date('Y-m-d--H-i-s');
        if (!isset($request->Foldername) || $request->Foldername == "") {
            $Foldername = (env('Name') . '-' . $time);
        } else {
            $Foldername = $request->Foldername;
        }

        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/$Foldername/")) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/images/$Foldername/", 0755);
        }
        $target = $_SERVER['DOCUMENT_ROOT'] . "/images/$Foldername/" . (env('Name') . '-' . $time . '.' . $request->file('userFile')->getClientOriginalExtension());
        move_uploaded_file($_FILES['userFile']['tmp_name'], $target);

        log_admin::create([
            'admin_id' => $adminid,
            'description' => "عکس " . $target . " اپلود کرد",
        ]);

        return ['folder' => $Foldername, 'name' => (env('Name') . '-' . $time . '.' . $request->file('userFile')->getClientOriginalExtension())];
    }

    public function addkala(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);

        $result = product::create([
            'name' => $request->name,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'special_price' => 0,
            'datetime' => date('Y-m-d--H-i-s'),
            'status' => 7,
            'category' => $request->category,
            'stock' => $request->stock,
            'order_number' => $request->order_number,
            'barcode' => $request->barcode,
            'description' => $request->description,
            'atcw' => 'no',
            'weight' => $request->weight,
            'image_folder' => $request->image_folder,
            'image_thumbnail' => $request->image_thumbnail,
        ]);

        log_admin::create([
            'admin_id' => $adminid,
            'description' => "[
                'name' => $request->name,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'special_price' => 1000,
                'datetime' => " . date('Y-m-d--H-i-s') . ",
                'status' => 1,
                'category' => $request->category,
                'stock' => $request->stock,
                'order_number' => $request->order_number,
                'barcode' => $request->barcode,
                'description' => $request->description,
                 'atcw' => 'no',
                'weight' => $request->weight,
                'image_folder' => $request->image_folder,
                'image_thumbnail' => $request->image_thumbnail,
            ]",
        ]);
        if ($result->wasRecentlyCreated) {
            return "ok";
        } else {
            return "fail";
        }
    }

    public function wearehouseCapacity(Request $request)
    {

        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);

        $text = $request->text;

        $result = DB::table('product')
            ->where('Name', 'LIKE', '%' . $text . '%')
            ->orWhere('product_id', '=', $text)
            ->get(['product_id', 'name', 'stock']);

        for ($i = 0; $i < $result->count(); $i++) {
            $temp = collect($result->get($i));


            $warehouses = DB::table('warehouse_capacity')
                ->where('product_id', '=', collect($result->get($i))['product_id'])
                ->join('warehouse', 'warehouse_capacity.warehouse_id', '=', 'warehouse.warehouse_id')
                ->select('warehouse_capacity.warehouse_id', 'warehouse.name', 'warehouse_capacity.number')
                ->get();

            $temp->put('warehouses', $warehouses);
            return ($temp);
        }


        return $result;
    }

    public function thumbnail(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);

        $temp = product::where('product_id', '=', $request->product_id)->update([
            'image_thumbnail' => $request->Imagename,
        ]);

        if ($temp > 0) {
            return "ok";
        } else {
            return "error";
        }

    }


    public function delete_factor_product(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);

        $result = DB::transaction(function () use ($request) {


            $factor_product = factor_product::where('factor_product_id', '=', $request->factor_product_id)
                ->where('factor_id', '=', $request->factor_id)
                ->where('status', '=', 'admin')
                ->get();


            factor_edite::create([
                'factor_id' => $factor_product->get(0)['factor_id'],
                'factor_product_id' => $factor_product->get(0)['factor_product_id'],
                'product_id' => $factor_product->get(0)['product_id'],
                'number' => $factor_product->get(0)['number'],
                'new_number' => 0,
                'price' => $factor_product->get(0)['price'],
                'old_price' => $factor_product->get(0)['old_price'],
                'weight' => $factor_product->get(0)['weight'],
                'payment' => $factor_product->get(0)['payment'],
                'payment_weight_change' => $factor_product->get(0)['payment_weight_change'],

            ]);

            $temp = product::where('product_id', '=', $factor_product->get(0)['product_id'])->get();
            product::where('product_id', '=', $factor_product->get(0)['product_id'])->update(['stock' => ($temp->get(0)['stock'] + $factor_product->get(0)['number'])]);


            factor_product::where('factor_product_id', '=', $request->factor_product_id)
                ->where('factor_id', '=', $request->factor_id)
                ->where('status', '=', 'admin')
                ->delete();

            return "زیر فاکتور حذف شد";
        });

        return $result;
    }

    public function add_factor_product(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);

        $result = DB::transaction(function () use ($request) {
            $product = product::where('product_id', '=', $request->product_id)->where('stock', '>=', $request->number)->get();

            if ($product->count() == 1) {

                $new_factor_product = factor_product::create([
                    'factor_id' => $request->factor_id,
                    'product_id' => $request->product_id,
                    'number' => $request->number,
                    'price' => $product->get(0)['price'],
                    'old_price' => $product->get(0)['old_price'],
                    'payment' => 'no',
                    'weight' => $product->get(0)['weight'],
                    'payment_weight_change' => 'no',
                    'status' => 'admin'
                ]);
                product::where('product_id', '=', $request->product_id)->update(['stock' => ($product->get(0)['stock'] - $request->number)]);

                factor_edite::create([
                    'factor_id' => $request->factor_id,
                    'factor_product_id' => $new_factor_product['factor_product_id'],
                    'product_id' => $request->product_id,
                    'number' => 0,
                    'new_number' => $request->number,
                    'price' => $product->get(0)['price'],
                    'old_price' => $product->get(0)['old_price'],
                    'payment' => 'no',
                ]);


                return "کالا " . $request->product_id . " به فاکتور اضافه شد ";
            } else {
                return "خطا";
            }
        });
        return $result;
    }


    public function factor_product_reject(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = DB::transaction(function () use ($request) {

            factor::where('factor_id', '=', $request->factor_id)
                ->update(['status' => 2]);

            factor_product::where('factor_product_id', '=', $request->factor_product_id)
                ->where('factor_id', '=', $request->factor_id)
                ->update(['status' => 'warehouse']);

            warehouse_order::where('warehouse_order_id', '=', $request->warehouse_order_id)
                ->update([
                    'status' => 'warehouse',
                    'weight_change_description' => $request->weight_change_description,
                    'weight_change' => 0,
                ]);


            return "ok";
        });
        return $result;
    }

    public function factor_product_change_warehouse(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = DB::transaction(function () use ($request) {

            $temp = warehouse_capacity::where('warehouse_id', '=', $request->warehouse_id)
                ->where('product_id', '=', $request->product_id)
                ->where('number', '>=', $request->number)
                ->get();

            if ($temp->count() == 1) {

                factor::where('factor_id', '=', $request->factor_id)
                    ->update(['status' => 2]);

                warehouse_order::where('warehouse_order_id', '=', $request->warehouse_order_id)
                    ->where('factor_product_id', '=', $request->factor_product_id)
                    ->where('factor_id', '=', $request->factor_id)
                    ->update(['status' => 'warehouse', 'warehouse_id' => $request->warehouse_id]);

                return "ok";
            } else {
                return "error";
            }
        });
        return $result;

    }

    public function way(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        $result = DB::transaction(function () use ($request) {
            $way = $request->way;
            if ($way == "nothing" || $way == "give_courier" || $way == "send_courier") {
                factor::where('factor_id', '=', $request->factor_id)
                    ->update(['status' => 5, 'difference_status' => $way]);
            } else if ($way == "give_gate" || $way == "send_card") {
                factor::where('factor_id', '=', $request->factor_id)
                    ->update(['status' => 4, 'difference_status' => $way]);
            }
            return "ok";
        });
        return $result;
    }

    public function send_to_courier(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);

        $result = DB::transaction(function () use ($request) {
            $factor_product = factor_product::where('factor_product.factor_id', '=', $request->factor_id)
                ->join('warehouse_order', 'factor_product.factor_product_id', '=', 'warehouse_order.factor_product_id')
                ->select(['*'])
                ->get();


            factor::where('factor_id', '=', $request->factor_id)->update(['status' => 7]);

            for ($i = 0; $i < $factor_product->count(); $i++) {

                factor_product::where('factor_product_id', '=', ($factor_product->get($i)['factor_product_id']))
                    ->update(['status' => 'delivery_waite']);

                warehouse_order::where('factor_product_id', '=', ($factor_product->get($i)['factor_product_id']))
                    ->update(['status' => 'warehouse']);

                courier_task::create([
                    'courier_id' => $request->courier_id,
                    'factor_id' => $request->factor_id,
                    'factor_product_id' => ($factor_product->get($i)['factor_product_id']),
                    'warehouse_id' => ($factor_product->get($i)['warehouse_id']),
                    'datetime_receive' => null,
                    'datetime_delivery' => null,
                ]);
            }
            return "ok";
        });
        return $result;

    }

    public function all_subcategory(Request $request)
    {
        $adminid = G::checkAdminToken($request->token) == false ? abort(response("You do not have access", 404)) : G::checkAdminToken($request->token);
        return sub_category::all();
    }

    public function createAdmin(Request $request)
    {
        return "disable";
        $result = admin::create([
            'username' => $request->username,
            'password' => G::getHash($request->password),
            'token' => G::getHash($request->username . Carbon::now()),
            'enabel' => 'no',
            'order_come' => 'no',
            'online' => 'no',
        ]);
        return $result;
    }
}
