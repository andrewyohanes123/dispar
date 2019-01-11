<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\News;
use App\Site;
use App\Banner;
use App\Note;

class RootController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setLocale(LC_ALL, 'IND');
        $news = News::orderBy('id', 'desc')->take(5)->get();
        $note = Note::latest()->first();
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        return view('home.main', compact('news', 'note', 'facility'));
    }

    public function news(Request $request)
    {
        $news = News::orderBy('created_at', 'DESC')->paginate(9);
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        if ($request->q) $news = News::search($request->q)->orderBy('created_at', 'DESC')->paginate(9);
        return view('home.news', compact('news', 'facility'));
    }

    public function show_news($year, $month, $slug)
    {
        $news = News::where('slug', $slug)->whereMonth('created_at', $month)->whereYear('created_at', $year)->get()->first();
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        return view('home.news-show', compact('news', 'facility'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
