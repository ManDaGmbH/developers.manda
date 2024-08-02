<?php

use Illuminate\Support\Facades\Route;

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

//Before authentication
Route::group(['middleware' => 'beforeAuth'], function() {
    Route::get('/', 'FrontendController@index');
    Route::get('page/{type?}', 'FrontendController@index');
    Route::get('/backend', 'Admin\UsersController@login');
    Route::get('backend/login', 'Admin\UsersController@login')->name('backend.login');
    Route::get('backend/forgotPassword', 'Admin\UsersController@recoverPassword');
    Route::get('backend/resetPassword/{token}', 'Admin\UsersController@resetPassword');

    Route::post('backend/login', 'Admin\UsersController@login');
    Route::post('recoverPassword', 'Admin\UsersController@recoverPassword');
});


//After authentication with prefix:backend
Route::prefix('backend')->name('admin.')->middleware('checkAuth')->group(function() {
    Route::resource('users', 'Admin\UsersController');
    Route::match(['get', 'post'], '/users-list', 'Admin\UsersController@index')->name('users.index');

    Route::resource('roles', 'Admin\RolesController');
    Route::get('user-profile', 'Admin\UsersController@profileEdit');
    Route::get('reset-password-manually/{email}', 'Admin\UsersController@resetpasswordmanually');
    Route::get('change-password', 'Admin\UsersController@changePassword');
    Route::get('dashboard', 'PagesController@dashboard');
    Route::post('logout', 'Admin\UsersController@logout')->name('logout');
    Route::patch('user-profile', 'Admin\UsersController@updateProfile')->name('user.profile');


    //for home page banner
    Route::resource('banners', 'BannerController')->except('show');
    Route::post('bannar_ajax_upload', 'BannerController@bannar_ajax_upload')->name('bannar_ajax_upload');
    Route::post('banners/sort-order', 'BannerController@sortData')->name('banner.sort.order');
//    Route::post('banners-upload', 'TrendingProductController@upload')->name('upload.widget.image');
    Route::get('change-status/{table}/{id}/{status}', 'BannerController@changeStatus')->name('admin.banner.change.status');

    Route::resource('pages', 'PagesController')->except('show');
    Route::get('page-details/{pageId}', 'PagesController@pageDetails')->name('page.details');
    Route::get('pages/edit/{id?}', 'PagesController@index');
    Route::get('page-details/create/{pageId}', 'PagesController@pageDetailCreate')->name('page.details.create');
    Route::post('page-details/store/{pageId}', 'PagesController@pageDetailStore')->name('page.details.store');
    Route::get('page-details/edit/{id}', 'PagesController@pageDetailEdit')->name('page.details.edit');
    Route::put('page-details/update/{id}', 'PagesController@pageDetailUpdate')->name('page.details.update');

    Route::get('categories', 'GalleriesController@categories')->name('categories.index');
    Route::post('categories/store', 'GalleriesController@categoriesStore')->name('categories.store');
    Route::get('categories/edit/{id}', 'GalleriesController@categoriesEdit')->name('categories.edit');
    Route::get('categories/create', 'GalleriesController@categoriesCreate')->name('categories.create');
    Route::put('categories/update/{id}', 'GalleriesController@categoriesUpdate')->name('categories.update');

    Route::get('galleries/{id}', 'GalleriesController@index')->name('galleries');
    Route::post('galleries/store/{id}', 'GalleriesController@store')->name('gelleries.store');
    Route::delete('galleries/destroy/{id}', 'GalleriesController@destroy')->name('galleries.destroy');
    Route::post('ck-editor/uploads', 'BannerController@ckeditorUpload')->name('ckeditor.upload');

    Route::delete('category/destroy/{id}', 'GalleriesController@destroyCategory')->name('category.destroy');
    Route::delete('page_details/destroy/{id}', 'PagesController@pageDetailDestroy')->name('page_details.destroy');
//    Route::post('galleries/store/{id}', 'GalleriesController@store')->name('gelleries.store');

    Route::get('contacts', 'PagesController@contacts');
    Route::delete('contacts/destroy/{id}', 'PagesController@ContactsDestroy')->name('contact.destroy');
});
Route::get('printt', 'PagesController@prints');
Route::post('upload/file', 'PagesController@uploadFile')->name('upload.file');
Route::get('convert-pdf', 'PagesController@convertPDF')->name('convertPDF');
Route::get('clear-pdf', 'PagesController@clearPDF')->name('clearPDF');

Route::post('changePassword', 'Admin\UsersController@changePassword');
Route::get('gallery/{slug}', 'FrontendController@gallery');
Route::get('contact', 'FrontendController@contact');
Route::post('send-message', 'FrontendController@sendMessage');

Route::get('/print-new', [App\Http\Controllers\FrontendController::class, 'PrintNew']);
Route::post('/print-new', [App\Http\Controllers\FrontendController::class, 'upload'])->name('print-new');
Route::get('convert-to-pdf/{randNumber}', 'PagesController@convertPDF2')->name('convert.to.pdf');

//Setting up API routes
Route::get('/apis/start-printing', [App\Http\Controllers\FrontendController::class, 'apiStartPrinting']);
Route::get('/apis/stop-printing', [App\Http\Controllers\PagesController::class, 'apiStopPrinting']);
//Route::post('/apis/upload-files', 'FrontendController@apiUploadFiles');
Route::post('/apis/upload-files', 'FrontendController@apiUploadFiles');
//Route::post('/apis/upload-files', [App\Http\Controllers\FrontendController::class, 'apiUploadFiles']);


