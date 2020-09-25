<?php

namespace App\Http\Controllers;

use App\Models\firstpage;
use App\Models\product;
use App\Models\warehouse;
use App\Models\warehouse_capacity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class SuperAdminController extends Controller
{
    public function clearimages()
    {

        return "disable";

        $images = Array();

        rename($_SERVER['DOCUMENT_ROOT'] . '/images/firstpage', '/home/cheemark/backup/firstpage');
        rename($_SERVER['DOCUMENT_ROOT'] . '/images/subcategory', '/home/cheemark/backup/subcategory');
        rename($_SERVER['DOCUMENT_ROOT'] . '/images/category', '/home/cheemark/backup/category');


        $folders = scandir(dirname(__DIR__, 4) . "/public_html/images/");

        $all = product::all();
        $count = product::all('image_folder')->count();
        for ($i = 0; $i < $count; $i++) {
            $images[] = $all->get($i)['image_folder'];

        }


        for ($i = 2; $i < sizeof($folders); $i++) {
            $delete = true;
            for ($b = 0; $b < sizeof($images); $b++) {
                if ($folders[$i] == $images[$b]) {
                    $delete = false;
                    break;
                }
            }

            if ($delete == true) {
                $this->deletedir($_SERVER['DOCUMENT_ROOT'] . '/images/' . $folders[$i]);
                echo "" . $_SERVER['DOCUMENT_ROOT'] . '/images/' . $folders[$i] . "\n";
            }
        }


        rename('/home/cheemark/backup/firstpage', $_SERVER['DOCUMENT_ROOT'] . '/images/firstpage');
        rename('/home/cheemark/backup/subcategory', $_SERVER['DOCUMENT_ROOT'] . '/images/subcategory');
        rename('/home/cheemark/backup/category', $_SERVER['DOCUMENT_ROOT'] . '/images/category');

        $images = Array();
        $folders = scandir(dirname(__DIR__, 4) . "/public_html/images/firstpage");

        $all = firstpage::all();

        for ($i = 0; $i < $all->count(); $i++) {

            $images[] = $all->get($i)['post_image'];

        }


        for ($i = 2; $i < sizeof($folders); $i++) {
            $delete = true;
            for ($b = 0; $b < sizeof($images); $b++) {
                if ($folders[$i] == $images[$b]) {
                    $delete = false;
                    break;
                }
            }

            if ($delete == true) {

                $file = $_SERVER['DOCUMENT_ROOT'] . '/images/firstpage/' . $folders[$i];

                if (!unlink($file)) {
                    echo("Error deleting $file");
                } else {
                    echo("Deleted $file");
                }
                echo "" . $_SERVER['DOCUMENT_ROOT'] . '/images/firstpage/' . $folders[$i] . "\n";
            }
        }

        return "ok";
    }

    private function deletedir($dir)
    {

        return "disable";
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
    }

    public function addfake()
    {
        return "disable";
        $result = DB::transaction(function () {
            warehouse_capacity::truncate();
            $sumstock = 30;
            $ordernumber = 10;

            DB::table('product')->update(['stock' => $sumstock, 'order_number' => $ordernumber]);

            $result = product::all();

            for ($i = 0; $i < $result->count(); $i++) {

                $temp = warehouse::all();
                for ($j = 0; $j < $temp->count(); $j++) {
                    warehouse_capacity::create([
                        'warehouse_id' => $temp->get($j)['warehouse_id'],
                        'product_id' => $result->get($i)['product_id'],
                        'number' => $sumstock,
                    ]);
                }

            }

            return false;

        });

    }

    public function somefolder(Request $request)
    {
        return "disable";
        $all = product::all();
        $ban = collect([]);
        $output = collect([]);
        for ($i = 0; $i < $all->count(); $i++) {

            for ($k = 0; $k < $ban->count(); $k++) {
                if ($k == $all->get($i)['product_id']) {
                    continue;
                }
            }
            $temp = collect([]);

            for ($j = $i + 1; $j < $all->count(); $j++) {
                if ($all->get($i)['image_folder'] == $all->get($j)['image_folder']) {
                    $temp->add($all->get($j)['product_id']);
                    $ban->add($all->get($j)['product_id']);

                }
            }
            $output->add($temp);

        }
        return $output;
    }

    public function fakefoldername(Request $request)
    {

        return "disable";
        $result = DB::transaction(function () use ($request) {
            $all = product::all();

            for ($i = 0; $i < $all->count(); $i++) {
                if (file_exists(dirname(__DIR__, 4) . "/public_html/images/" . $all->get($i)['image_folder'])) {
                    /*$folders = scandir(dirname(__DIR__, 4) . "/public_html/images/" . $all->get($i)['image_folder']);
                    if(!collect($folders)->count() == 3){
                        echo $all->get($i)['product_id'] . "\n";
                    }*/
                } else {
                    echo $all->get($i)['product_id'] . "\n";
                }


                //  dd(substr($folders[2],0,strlen($folders[2]) - 4));
            }
        });
        /*
        $result = DB::transaction(function () use ($request) {


            $all = product::all();

            // 390 = 0 - 100  --- 100 - 200  --- 200 - 300 --- 300 - 390 ba alamat + 3
            for ($i = 300; $i < 390/*$all->count(); $i++) {

                $time = date('Y-m-d--H-i-s');
                $Foldername = (env('Name') . '-' . $time);

                mkdir($_SERVER['DOCUMENT_ROOT'] . "/images/$Foldername/", 0755);
                product::where('product_id', '=', $all->get($i)['product_id'])->update([
                    'image_folder' => $Foldername,
                ]);

                sleep(1);
            }
        });
*/
        return $result;


    }

    public function fiximages(Request $request)
    {
        $all = product::all();
        for ($i = 0; $i < $all->count(); $i++) {
            echo "product =" . $all->get($i)['product_id'] . "\n";
            echo  "/////////////////";
            for ($j = $i + 1; $j < $all->count(); $j++) {
                if ($all->get($i)['image_folder'] == $all->get($j)['image_folder']) {
                    echo  "_" . $all->get($j)['product_id'] ;
                }
            }
            echo "\n" . "/////////////////" . "\n";
        }
        return "disabels";
        /*
                return "disabels";
                $folders = collect(scandir(dirname(__DIR__, 4) . "/public_html/images/"));
                $images = collect([]);
                for ($i = 2; $i < $folders->count(); $i++) {
                    $folder = collect(scandir(dirname(__DIR__, 4) . "/public_html/images/" . $folders[$i]));
                    for ($j = 2; $j < $folder->count(); $j++) {
                        $images->add($folder[$j]);
                    }
                }
                $some = collect([]);
                for ($k = 0; $k < $images->count(); $k++) {
                    for ($i = $k + 1; $i < $images->count(); $i++) {
                        if ($images[$k] == $images[$i]) {
                            $some->add($images[$k]);
                        }
                    }
                }

                dd($some);

                return "disabels";
        */
        rename($_SERVER['DOCUMENT_ROOT'] . '/images/firstpage', '/home/cheemark/backup/firstpage');
        rename($_SERVER['DOCUMENT_ROOT'] . '/images/subcategory', '/home/cheemark/backup/subcategory');
        rename($_SERVER['DOCUMENT_ROOT'] . '/images/category', '/home/cheemark/backup/category');


        $result = DB::transaction(function () use ($request) {
            $all = product::all();

            for ($i = 0; $i < $all->count(); $i++) {

                if (file_exists(dirname(__DIR__, 4) . "/public_html/images/" . $all->get($i)['image_folder'])) {
                    $inner_images = scandir(dirname(__DIR__, 4) . "/public_html/images/" . $all->get($i)['image_folder']);
                    if (collect($inner_images)->count() >= 3) {

                        $image_name = $inner_images[2];

                        rename(dirname(__DIR__, 4) . "/public_html/images/" . $all->get($i)['image_folder']
                            , dirname(__DIR__, 4) . "/public_html/images/" . substr($image_name, 0, strlen($image_name) - 4));

                        product::where('product_id', '=', $all->get($i)['product_id'])
                            ->update([
                                'image_thumbnail' => $image_name,
                                'image_folder' => substr($image_name, 0, strlen($image_name) - 4)
                            ]);
                    }
                }
            }
        });
        rename('/home/cheemark/backup/firstpage', $_SERVER['DOCUMENT_ROOT'] . '/images/firstpage');
        rename('/home/cheemark/backup/subcategory', $_SERVER['DOCUMENT_ROOT'] . '/images/subcategory');
        rename('/home/cheemark/backup/category', $_SERVER['DOCUMENT_ROOT'] . '/images/category');
    }

    function dir_is_empty($dir)
    {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                closedir($handle);
                return FALSE;
            }
        }
        closedir($handle);
        return TRUE;
    }

    public function replace(Request $request)
    {

        return "disable";

        rename($_SERVER['DOCUMENT_ROOT'] . '/images/firstpage', '/home/cheemark/backup/firstpage');
        rename($_SERVER['DOCUMENT_ROOT'] . '/images/subcategory', '/home/cheemark/backup/subcategory');
        rename($_SERVER['DOCUMENT_ROOT'] . '/images/category', '/home/cheemark/backup/category');

        $home_path = scandir(dirname(__DIR__, 4) . "/public_html/images");
        $target_path = scandir(dirname(__DIR__, 4) . "/public_html/new");


        for ($j = 2; $j < collect($target_path)->count(); $j++) {
            $image_name = substr($target_path[$j], 0, strlen($target_path[$j]) - 4);

            for ($i = 2; $i < collect($home_path)->count(); $i++) { // baraye folder ha
                $folder = $home_path[$i];
                $inner_images = scandir(dirname(__DIR__, 4) . "/public_html/images/" . $folder);

                for ($k = 2; $k < collect($inner_images)->count(); $k++) { // baraye image haye toye har folder
                    $inner_image_name = substr($inner_images[$k], 0, strlen($inner_images[$k]) - 4);

                    if ($image_name == $inner_image_name) {


                        if (!unlink(dirname(__DIR__, 4) . "/public_html/images/" . $folder . '/' . $inner_images[$k])) {
                            echo("Error deleting");
                        } else {
                            rename(dirname(__DIR__, 4) . "/public_html/new/" . $target_path[$j], dirname(__DIR__, 4) . "/public_html/images/" . $folder . "/" . $target_path[$j]);
                        }

                    }
                }

            }


        }

        rename('/home/cheemark/backup/firstpage', $_SERVER['DOCUMENT_ROOT'] . '/images/firstpage');
        rename('/home/cheemark/backup/subcategory', $_SERVER['DOCUMENT_ROOT'] . '/images/subcategory');
        rename('/home/cheemark/backup/category', $_SERVER['DOCUMENT_ROOT'] . '/images/category');

    }

    public function setspical(Request $request)
    {

        return "disable";
        $date = $request->date;
        $products = firstpage::where('location', '=', 1)->get();
        for ($i = 0; $i < $products->count(); $i++) {
            $product = product::where('product_id', '=', $products[$i]['product_id'])->get();
            product::where('product_id', '=', $products[$i]['product_id'])
                ->update(['datetime' => $date, 'special_price' => $product->get(0)['price'], 'old_price' => ($product->get(0)['old_price'] + 1000)
                    , 'price' => ($product->get(0)['price'] + 1000), 'status' => 2]);

        }
        dd($products[0]['product_id']);
    }

}
