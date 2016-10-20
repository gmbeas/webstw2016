<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PromocionController extends Controller
{
    //

    public function indexCiberMonday2016()
    {

        $data = getLanding("29", "CYBERMONDAY");
        return view('promocion.cibermonday')
            ->with('productos', $data);
    }
}
