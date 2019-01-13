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
        $sites = Site::whereHas('site_type', function ($q) {
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
        // return $request->file('photo');
        // dd($request->hasFile('photo'));
        $request->validate([
            'name' => 'required|min:4',
            'address' => 'required|min:4',
            'description' => 'required|min:10',
            'travel_type_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        ], [
            'name.required' => 'Masukkan nama tempat wisata',
            'name.min' => 'Nama tempat wisata harus lebih dari atau sama dengan 4 karakter',
            'address.required' => 'Masukkan alamat tempat wisata',
            'address.min' => 'Alamat tempat wisata harus lebih dari atau sama dengan 4 karakter',
            'description.required' => 'Masukkan deskripsi tempat wisata',
            'description.min' => 'Deskripsi tempat wisata harus lebih dari atau sama dengan 4 karakter',
            'travel_type_id.required' => 'Pilih tipe wisata',
            'photo.required' => 'Masukkan gambar tempat wisata',
            'photo.filr' => 'Gambar tempat wisata harus file',
            'photo.required' => 'Format gambar tempat wisata adalah JPEG, JPG, dan PNG',
            'photo.max' => 'Besar file gambar tempat wisata adalah 2MB',
        ]);

        $result = Site::create([
            'name' => $request->name,
            'slug' => str_slug(strtolower($request->name)),
            'address' => $request->address,
            'description' => $request->description,
            'site_type_id' => 5,
            'travel_type_id' => $request->travel_type_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if ($result) {
            if ($request->hasFile('photo')) {
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $ext = $request->file('photo')->getClientOriginalExtension();
                $file = $filename . "_" . time() . '.' . $ext;
                $path = $request->file('photo')->storeAs('public/img', $file);
                $upload = SitePicture::create(['photo' => $file, 'site_id' => $result->id]);
            }
            return ['site' => $result, 'file' => $upload];
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
        $sites = Site::orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard.travel-show', compact('site', 'sites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel = Site::findOrFail($id);
        return view('dashboard.travel-edit', compact('travel'));
    }

    public function api($id)
    {
        return Site::with(['travel_type', 'site_type', 'site_pictures'])->findOrFail($id);
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
        $request->validate([
            'name' => 'required|min:4',
            'address' => 'required|min:4',
            'description' => 'required|min:10',
            'travel_type_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'name.required' => 'Masukkan nama tempat wisata',
            'name.min' => 'Nama tempat wisata harus lebih dari atau sama dengan 4 karakter',
            'address.required' => 'Masukkan alamat tempat wisata',
            'address.min' => 'Alamat tempat wisata harus lebih dari atau sama dengan 4 karakter',
            'description.required' => 'Masukkan deskripsi tempat wisata',
            'description.min' => 'Deskripsi tempat wisata harus lebih dari atau sama dengan 4 karakter',
            'travel_type_id.required' => 'Pilih tipe wisata',
        ]);

        return Site::where('id', $id)->update([
            'name' => $request->name,
            'slug' => str_slug(strtolower($request->name)),
            'address' => $request->address,
            'description' => $request->description,
            'travel_type_id' => $request->travel_type_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Site::destroy($id);
    }
}
