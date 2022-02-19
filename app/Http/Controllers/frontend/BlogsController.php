<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\PagesFeatures;
use Illuminate\Http\Request;
use stdClass;

class BlogsController extends Controller
{
    public function index()
    {
        $feature = PagesFeatures::where('page_id', '=', 7)->get();
        $blog=Blog::orderBy('updated_at')->paginate(12);
        $page=new stdClass();
        foreach ($feature as $key => $value) {
            $page->{
                ltrim(strpbrk($value['feature_key'] , "." ),'. ')} = $value['feature_value'];
        }
        return view('frontend.page.yazilarimiz',compact('blog','page'));
    }

    public function show($slug)
    {
        $blog=Blog::where('slug','=',$slug)->firstOrFail();
        $blogs=Blog::orderBy('updated_at')->get();
        return view('frontend.page.single_blog',compact('blog','blogs'));
    }

}
