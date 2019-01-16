<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'RootController@index')->name('root')->middleware('visitor');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{slug}', 'HomeController@show')->name('home.show');

Route::get('/berita', 'RootController@news')->name('root.news');
Route::get('/berita/{year}/{month}/{slug}', 'RootController@show_news')->name('root.show-news');
Route::get('/tempat-wisata', 'SiteController@index')->name('root.sites');
Route::get('/tempat-wisata/{slug}', 'SiteController@show')->name('root.site-show');
Route::get('/gallery', 'GalleryController@index')->name('root.galleries');
Route::get('/gallery-api', 'GalleryController@api');
Route::get('/fasilitas/{nama}', 'FacilityController@index')->name('root.facilities');
Route::get('/fasilitas/{nama}/{slug}', 'FacilityController@show')->name('root.facilities-show');
Route::get('/visi-misi', 'PointsController@index')->name('root.point');
Route::get('/event', 'EventCalendarController@home')->name('root.events');
Route::get('event-api', 'EventCalendarController@api');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
  Route::get('/main', function () {
    $main = \App\News::count();
    $site = \App\Site::where('site_type_id', 5)->count();
    $facilities = \App\Site::whereNotIn('site_type_id', [5])->count();
    $pics = \App\SitePicture::count();
    $info = \App\Note::orderBy('id', 'DESC')->get()->first();
    $banner = \App\Banner::orderBy('id', 'DESC')->get()->last();
    $point = \App\Point::orderBy('id', 'desc')->take(1)->first();
    return view('dashboard.main', compact('main', 'site', 'pics', 'facilities', 'info', 'banner', 'point'));
  })->name('dashboard.main');
  Route::post('/site-picture', 'SitePictureController@store');
  Route::post('/visi-misi', 'PointsController@store')->name('dashboard.point');
  Route::resource('berita', 'NewsController');
  Route::resource('tempat-wisata', 'TravelSiteController');
  Route::get('/tempat-wisata/{id}/api', 'TravelSiteController@api');
  Route::resource('fasilitas-wisata', 'FacilitiesController');
  Route::resource('kalender-kegiatan', 'EventCalendarController');
  Route::get('event-api', 'EventCalendarController@api');
  Route::redirect('/', '/dashboard/main', 301);
  Route::get('/travel-site', 'SiteControllerAPI@index');
});

Route::match(['get', 'post'], 'register', function(){
  return redirect('/');
});