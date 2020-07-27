<?php

use Illuminate\Support\Facades\Route;
use App\SitePage;
use App\SiteConfig;

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

Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware('auth.basic');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contactUs');

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/', function () {
	    return view('admin.index');
	})->name('admin.index')->middleware('auth');

	Route::get('/manage-images', function () {
	    return view('admin.manage-images');
	})->name('admin.manageImages')->middleware('auth');

	Route::get('/manage-pages', function () {
		$pages = SitePage::all();
	    return view('admin.manage-pages', ['pages' => $pages]);
	})->name('admin.managePages')->middleware('auth');

	Route::get('/site-config', function () {
		$configContactEmail = SiteConfig::where('key', 'contact_email')->first();
		$configGoogleTrackingId = SiteConfig::where('key', 'google_analytics_tracking_id')->first();
		$configFbPixelCode = SiteConfig::where('key', 'fb_pixel_code')->first();
	    return view('admin.site-config', [
	    	'contact_email' => $configContactEmail->value,
	    	'google_analytics_tracking_id' => $configGoogleTrackingId->value,
	    	'fb_pixel_code' => $configFbPixelCode->value
	    ]);
	})->name('admin.siteConfig')->middleware('auth');
});

Route::post('photo', 'ImageController@save')->middleware('auth');
Route::post('savePage', 'ManagePagesController@save')->middleware('auth');
Route::post('saveSiteConfig', 'ManagePagesController@saveSiteConfig')->middleware('auth');
Route::post('contactForm', 'ManagePagesController@contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
