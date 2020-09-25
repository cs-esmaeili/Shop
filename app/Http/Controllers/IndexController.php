<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function donwloadlink()
    {
        $folder = scandir(dirname(__DIR__, 4) . "/public_html/app");
        return view("web.download", ['link' => '/app/' . $folder[sizeof($folder) - 1] .'' ]);
    }

}
