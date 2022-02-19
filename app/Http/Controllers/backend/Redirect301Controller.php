<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\PagesFeatures;
use Illuminate\Http\Request;
use stdClass;

class Redirect301Controller extends Controller
{
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
