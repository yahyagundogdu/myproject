<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\GaleryCategory;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function resimler()
    {
        $gallery=GaleryCategory::all();
        $gallery_data=Gallery::where('category_id','=',$gallery[0]['id'])->first();
        return  view('frontend.page.gallery',compact('gallery'));
    }
    public function resimdetay($slug)
    {
        $gallery=GaleryCategory::where('slug','=',$slug)->first();
        $gallery_data=Gallery::where('category_id','=',$gallery->id)->get();
        return view('frontend.page.gallery_detail',compact('gallery_data','gallery'));
    }
}
