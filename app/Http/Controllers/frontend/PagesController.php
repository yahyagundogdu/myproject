<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\PagesFeatures;
use stdClass;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        if ($slug == '#') {
            return redirect()->back();
        }
        $page = Pages::where('slug', '=', $slug)->first();
        if($page==null){
            return redirect()->route('frontend.index');
        }
        $feature = PagesFeatures::where('page_id', '=', $page->id)->get();

        $pagefeature=new stdClass();
        foreach ($feature as $key => $value) {
            $pagefeature->{ltrim(strpbrk($value['feature_key'] , "." ),'.')} = $value['feature_value'];
        }
        return view('frontend.pageview.pageview', compact('page', 'pagefeature'));
    }
}
