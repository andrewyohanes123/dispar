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

Route::get('/', 'RootController@index')->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{slug}', 'HomeController@show')->name('home.show');

Route::get('/berita', 'RootController@news')->name('root.news');
Route::get('/berita/{year}/{month}/{slug}', 'RootController@show_news')->name('root.show-news');
Route::get('/tempat-wisata', 'SiteController@index')->name('root.sites');
Route::get('/tempat-wisata/{slug}', 'SiteController@show')->name('root.site-show');
Route::get('/gallery', 'GalleryController@index')->name('root.galleries');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
  Route::get('/main', function () {
    $main = \App\News::count();
    $site = \App\Site::where('site_type_id', 5)->count();
    $facilities = \App\Site::whereNotIn('site_type_id', [5])->count();
    $pics = \App\SitePicture::count();
    $info = \App\Note::orderBy('id', 'DESC')->get()->first();
    return view('dashboard.main', compact('main', 'site', 'pics', 'facilities', 'info'));
  })->name('dashboard.main');
  Route::resource('berita', 'NewsController');
  Route::resource('tempat-wisata', 'TravelSiteController');
  Route::redirect('/', '/dashboard/main', 301);
});