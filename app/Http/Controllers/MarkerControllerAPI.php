<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class MarkerControllerAPI extends Controller
{
    public function index()
    {
        return Site::with(['site_type', 'travel_type'])->get();
    }
}
