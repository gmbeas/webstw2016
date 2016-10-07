<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PromocionController extends Controller
{
    //

    public function indexCiberMonday2016()
    {


        return view('promocion.cibermonday');
    }
}
