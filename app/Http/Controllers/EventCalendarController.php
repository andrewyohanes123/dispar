<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\EventCalendar;
use App\EventLocation;
use App\EventPicture;

class EventCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = EventCalendar::all();
        return view('dashboard.events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.events-create');
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
            'name' => 'required|min:4',
            'date' => 'required',
            'description' => 'required|min:4',
            'picture' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required'
        ], [
            'name.required' => 'Masukkan nama event',
            'name.min' => 'Nama event minimal 4 karakter',
            'date.required' => 'Pilih tanggal event',
            'description.required' => 'Masukkan deskripsi event',
            'description.min' => 'Deskripsi event minimal 4 karakter',
            'address.required' => 'Pilih lokasi pada map',
            'picture.required' => 'Pilih gambar event',
            'picture.file' => 'Harus berupa file',
            'picture.mimes' => 'File gambar harus berupa JPEG, JPG, PNG',
            'picture.max' => 'Maksimal size file gambar adalah 2 MB',
        ]);

        $date = explode(' to ', $request->date);
        // dd($date);
        $event = EventCalendar::create([
            'name' => $request->name,
            'event_from' => $date[0],
            'event_to' => $date[1],
            'description' => $request->description
        ]);

        if ($event) {
            EventLocation::create([
                'location' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'event_calendar_id' => $event->id
            ]);

            if ($request->hasFile('picture')) {
                if ($request->hasFile('picture'))
                {
                    $filenameWithExt = $request->file('picture')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $ext = $request->file('picture')->getClientOriginalExtension();
                    $file = $filename . "_" . time() . '.' . $ext;
                    $path = $request->file('picture')->storeAs('public/img',$file);
                    EventPicture::create([
                        'picture' => $file,
                        'event_calendar_id' => $event->id,
                        'user_id' => Auth::user()->id
                    ]);
                }

                return redirect()->route('kalender-kegiatan.index');
            }
        }
    }

    public function api(Request $request)
    {
        return EventCalendar::with(['event_pictures.user', 'event_location'])->whereMonth('event_from', $request->month)->paginate();
    }

    public function home()
    {
        $facility = \App\SiteType::whereNotIn('id', [5])->get();
        return view('home.event', compact('facility'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = EventCalendar::findOrFail($id);
        return view('dashboard.event-edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'description' => 'required'
        ]);

        $date = explode(' to ', $request->date);

        EventCalendar::where('id', $id)->update([
            'name' => $request->name,
            'event_from' => $date[0],
            'event_to' => $date[1],
            'description' => $request->description 
        ]);

        return redirect()->route('kalender-kegiatan.edit', compact('id'));
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
