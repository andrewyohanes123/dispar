<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = \App\News::all();
        return view('home', compact('items'));
    }

    public function show($slug)
    {
        $item = \App\News::where('slug', $slug)->first();
        return view('news', compact('item'));
    }
}
