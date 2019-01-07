<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class SiteControllerAPI extends Controller
{
    public function index(Request $request)
    {
        if ($request->q) {
            return Site::search($request->q)->  with(['site_type', 'site_pictures', 'travel_type'])->where('site_type_id', 5)->paginate(9)->toJson();
        }
        return Site::with(['site_type', 'site_pictures', 'travel_type'])->where('site_type_id', 5)->paginate(9)->toJson();
    }
}
