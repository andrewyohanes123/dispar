<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TravelTypeAPI extends Controller
{
    public function index()
    {
        return \App\TravelType::all();
    }
}
