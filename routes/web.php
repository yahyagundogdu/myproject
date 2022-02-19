<?php

use App\Http\Controllers\frontend\BlogsController;
use App\Http\Controllers\frontend\EkipController;
use App\Http\Controllers\frontend\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\PagesController;
use App\Http\Controllers\frontend\RandevuCreate;
use App\Models\Blog;
use App\Models\GaleryCategory;
use App\Models\ModuleDatas;
use App\Models\Pages;
use App\Models\PagesFeatures;
use App\Models\Slide;
use Illuminate\Support\Facades\Artisan;

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
Route::get('key',function(){
    Artisan::call('storage:link');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
});
Route::resource('kayit-randevu', RandevuCreate::class)->names(['store' => 'randevuolustur']);

Route::get('/', function () {
    $slide=Slide::all();
    $cart_sub = ModuleDatas::where('module_id', '=', 3)->get();
    $cart=collect($cart_sub);
    $feature = PagesFeatures::where('page_id', '=', 5)->get();
    $ekibimiz = ModuleDatas::where('module_id', '=', 2)->get();
    $page_cart = ModuleDatas::where('module_id', '=', 4)->get();
    $yorumlar = ModuleDatas::where('module_id', '=', 5)->get();
    $blog=Blog::orderBy('updated_at')->take(4)->get();
    $page=new stdClass();
    foreach ($feature as $key => $value) {
        $page->{
            ltrim(strpbrk($value['feature_key'] , "." ),'. ')} = $value['feature_value'];
    }
    return view('frontend.page.home',compact('slide','cart','page','page_cart','ekibimiz','blog','yorumlar'));
})->name('frontend.index');

Route::resource('tedaviler', BlogsController::class)->names([
    'index'=>'tedaviler',
    'show' => 'blogPage',
]);

Route::get('/hakkimizda', function () {
    $feature = PagesFeatures::where('page_id', '=', 6)->get();
    $page=new stdClass();
    foreach ($feature as $key => $value) {
        $page->{
            ltrim(strpbrk($value['feature_key'] , "." ),'. ')} = $value['feature_value'];
    }
    return view('frontend.page.hakkimizda',compact('page'));
})->name('hakkimizda');

Route::resource('/ekibimiz', EkipController::class)->names([
    'index'=>'ekibimiz',
    'show'=>'ekibimiz.show',
]);

Route::get('/iletişim', function () {
    $feature = PagesFeatures::where('page_id', '=', 9)->get();
    $page=new stdClass();
    foreach ($feature as $key => $value) {
        $page->{
            ltrim(strpbrk($value['feature_key'] , "." ),'. ')} = $value['feature_value'];
    }
    return view('frontend.page.iletisim',compact('page'));
})->name('iletisim');

Route::get('/galeri', [GalleryController::class,'resimler'])->name('resimler');

Route::get('/galeri/{slug}', [GalleryController::class,'resimdetay'])->name('resimdetay');


Route::get('/sikca-sorulan-sorular', function () {
    $feature = PagesFeatures::where('page_id', '=', 11)->get();
    $page=new stdClass();
    foreach ($feature as $key => $value) {
        $page->{
            ltrim(strpbrk($value['feature_key'] , "." ),'. ')} = $value['feature_value'];
    }
    $data = ModuleDatas::where('module_id', '=', 1)->get();
    return view('frontend.page.sss', compact('data','page'));
})->name('sss');

Route::get('/{slug}', [PagesController::class, 'index'])->name('allPage');
