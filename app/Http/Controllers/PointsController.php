<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        $point = Point::orderBy('id', 'desc')->get()->take(1)->first();
        return view('home.point', compact('point', 'facility'));
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
     * @param  \App\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function show(Points $points)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function edit(Points $points)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Points $points)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function destroy(Points $points)
    {
        //
    }
}
