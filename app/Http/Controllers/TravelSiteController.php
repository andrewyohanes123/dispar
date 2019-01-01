<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\TravelType;
use App\SitePicture;

class TravelSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::whereHas('site_type', function($q) {
            $q->where('name', 'Objek Wisata');
        })->paginate(6);
        return view('dashboard.travel', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TravelType::all();
        return view('dashboard.travel-create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->hasFile('photo'));
        $request->validate([
            'name' => 'required|min:4',
            'address' => 'required|min:4',
            'description' => 'required|min:10',
            'travel_type_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'required|file|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        $result = Site::create([
            'name' => $request->name,
            'slug' => str_slug(strtolower($request->name)),
            'address' => $request->address,
            'description' => $request->description,
            'site_type_id' => 5,
            'travel_type_id' => $request->travel_type_id,
            'latitude' => 124.185,
            'longitude' => 1.567
        ]);

        if ($result) {
            if ($request->hasFile('photo'))
            {
                $files = [];
                foreach($request->photo as $i => $pic) {
                    // var_dump($pic);
                    $filenameWithExt = $pic->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $ext = $pic->getClientOriginalExtension();
                    $file = $filename . "_" . time() . '.' . $ext;
                    $path = $pic->storeAs('public/img',$file);
                    $files[$i] = ['photo' => $file, 'site_id' => 1];
                }
                // return $files;
            }

            SitePicture::create($files);

            return redirect()->route('tempat-wisata.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = Site::findOrFail($id);
        return view('dashboard.travel-show', compact('site'));
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
