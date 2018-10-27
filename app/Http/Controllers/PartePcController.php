<?php

namespace appComercial\Http\Controllers;

use appComercial\PartePc;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

class PartePcController extends Controller
{
    public function index(){

        $partespc = PartePc::all();

        return $partespc;

    }
}
