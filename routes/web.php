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
})->name('home');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contactUs');

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/', function () {
	    return view('admin.index');
	})->name('admin.index');

	Route::get('/manage-images', function () {
	    return view('admin.manage-images');
	})->name('admin.manageImages');

	Route::get('/manage-pages', function () {
		$pages = SitePage::all();
	    return view('admin.manage-pages', ['pages' => $pages]);
	})->name('admin.managePages');

	Route::get('/site-config', function () {
		$configContactEmail = SiteConfig::where('key', 'contact_email')->first();
		$configGoogleTrackingId = SiteConfig::where('key', 'google_analytics_tracking_id')->first();
		$configFbPixelCode = SiteConfig::where('key', 'fb_pixel_code')->first();
	    return view('admin.site-config', [
	    	'contact_email' => $configContactEmail->value,
	    	'google_analytics_tracking_id' => $configGoogleTrackingId->value,
	    	'fb_pixel_code' => $configFbPixelCode->value
	    ]);
	})->name('admin.siteConfig');
});

Route::post('photo', 'ImageController@save');
Route::post('savePage', 'ManagePagesController@save');
Route::post('saveSiteConfig', 'ManagePagesController@saveSiteConfig');
Route::post('contactForm', 'ManagePagesController@contact');
