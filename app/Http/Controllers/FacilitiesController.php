<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\SiteType;
use App\Facility;
use App\SitePicture;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Site::whereNotIn('site_type_id', [5])->orderBy('created_at', 'desc')->paginate(9);
        return view('dashboard.facilities', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = SiteType::whereNotIn('id', [5])->get();
        return view('dashboard.facilities-create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'site_type_id' => 'required',
            'description' => 'required',
            'photo' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        ], [
            'name.required' => 'Masukkan nama fasilitas wisata',
            'address.required' => 'Masukkan alamat fasilitas wisata',
            'site_type_id.required' => 'Masukkan tipe fasilitas wisata',
            'description.required' => 'Masukkan deskripsi fasilitas wisata',
            'photo.required' => 'Masukkan gambar fasilitas wisata',
            'photo.file' => 'Foto harus berupa file',
            'photo.mimes' => 'File foto yang diperbolehkan adalah JPEG, JPG, dan PNG',
            'photo.max' => 'Ukuran maks file foto adalah 2 MB',
        ]);

        $result = Site::create([
            'name' => $request->name,
            'slug' => str_slug(strtolower($request->name)),
            'address' => $request->address,
            'site_type_id' => $request->site_type_id,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if (count($request->facility) > 1 && $request->facility->first() !== null) :
            foreach($request->facility as $item) {
                Facility::create(['facility' => $item, 'site_id' => $result->id]);
            }
        endif;



        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('photo')->getClientOriginalExtension();
            $file = $filename . "_" . time() . '.' . $ext;
            $path = $request->file('photo')->storeAs('public/img', $file);
            SitePicture::create(['photo' => $file, 'site_id' => $result->id]);
        }
        
        return redirect()->route('fasilitas-wisata.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facility = Site::findOrFail($id);
        return view('dashboard.facilities-show', compact('facility'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facility = Site::findOrFail($id);
        $types = SiteType::whereNotIn('id', [5])->get();
        return view('dashboard.facilities-edit', compact('facility', 'types'));
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
            'name' => 'required',
            'address' => 'required',
            'site_type_id' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'nullable|file|mimes:jpeg,jpg,png|max:2048'
        ], [
            'name.required' => 'Masukkan nama fasilitas wisata',
            'address.required' => 'Masukkan alamat fasilitas wisata',
            'site_type_id.required' => 'Masukkan tipe fasilitas wisata',
            'description.required' => 'Masukkan deskripsi fasilitas wisata',
            'photo.file' => 'Foto harus berupa file',
            'photo.mimes' => 'File foto yang diperbolehkan adalah JPEG, JPG, dan PNG',
            'photo.max' => 'Ukuran maks file foto adalah 2 MB',
        ]);

        Site::where('id', $id)->update([
            'name' => $request->name,
            'slug' => str_slug(strtolower($request->name)),
            'address' => $request->address,
            'site_type_id' => $request->site_type_id,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('photo')->getClientOriginalExtension();
            $file = $filename . "_" . time() . '.' . $ext;
            $path = $request->file('photo')->storeAs('public/img', $file);
            SitePicture::where('id', $pic)->update(['photo' => $file, 'site_id' => $id]);
        }

        return redirect()->route('fasilitas-wisata.edit', compact('id'));
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
