<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::orderBy('created_at', 'DESC')->paginate(10);
        if ($request->q) $news = News::search($request->q)->orderBy('created_at', 'DESC')->paginate(10);
        return view('dashboard.news', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.news-create');
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
            'title' => 'required|min:4',
            'hero_img' => 'required|file|mimes:png,jpg,jpeg,gif|max:2048',
            'content' => 'required|min:10'
        ], [
            'title.required' => 'Masukkan judul berita',
            'title.min' => 'Judul berita harus lebih dari atau sama dengan 4 karakter',
            'hero_img.required' => 'Masukkan cover berita',
            'hero_img.mimes' => 'Cover berita harus berupa file gambar',
            'hero_img.max' => 'Ukuran maksimal cover berita adalah 2MB',
            'content.required' => 'Masukkan isi berita',
            'content.min' => 'Isi berita harus lebih dari atau sama dengan 10 karakter'
        ]);

        if ($request->hasFile('hero_img'))
        {
            $filenameWithExt = $request->file('hero_img')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('hero_img')->getClientOriginalExtension();
            $file = $filename . "_" . time() . '.' . $ext;
            $path = $request->file('hero_img')->storeAs('public/img',$file);
        }

        if (News::create([
            'title' => $request->title,
            'slug' => str_slug(strtolower($request->title), '-'),
            'content' => $request->content,
            'hero_img' => $file,
            'user_id' => Auth::user()->id
        ])) {
            return redirect()->route('berita.index');
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
        $news = News::findOrFail($id);
        return view('dashboard.news-show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('dashboard.news-edit', compact('news'));
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
        News::destroy($id);
        return redirect()->route('berita.index');
    }
}
