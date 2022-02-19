<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog=Blog::all();
        return view('backend.pages.blog.blogs',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=BlogCategory::all();
        return view('backend.pages.blog.new_edit_blog',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3',
            'slug' => 'required|unique:blogs,slug',
        ]);

        if ($request->anahtar!=null) {
        $anahtar_array=array();
        $data=json_decode($request->anahtar,true);

        foreach($data as $value){
            $anahtar_array[]=mb_convert_encoding($value['value'], "UTF-8");
        }
        }
        $slug=Str::slug($request->slug);
        $blog=new Blog();
        $blog->photo=$request->filepath;
        $blog->title=$request->title;
        $blog->body=$request->body;
        if($request->anahtar){
            $blog->etiketler=json_encode($anahtar_array,JSON_UNESCAPED_UNICODE);
        }else{
            $blog->etiketler=null;
        }
        $blog->slug=$slug;
        $blog->category_id=$request->kategori;
        $blog->status=$request->yayin;
        $blog->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogDuzenle=Blog::find($id);
        $category=BlogCategory::all();
        return view('backend.pages.blog.new_edit_blog',compact('blogDuzenle','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog=Blog::find($id);
        $validate=$request->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3',
            'slug' => 'required|unique:blogs,slug,'.$blog->id,
        ]);

        if ($request->anahtar!=null) {
            $anahtar_array=array();
            $data=json_decode($request->anahtar,true);

            foreach($data as $value){
                $anahtar_array[]=mb_convert_encoding($value['value'], "UTF-8");
            }
        }

        $slug=Str::slug($request->slug);
        $blog->photo=$request->filepath;
        $blog->title=$request->title;
        $blog->body=$request->body;
        if($request->anahtar){
            $blog->etiketler=json_encode($anahtar_array,JSON_UNESCAPED_UNICODE);
        }else{
            $blog->etiketler=null;
        }
        $blog->slug=$slug;
        $blog->category_id=$request->kategori;
        $blog->status=$request->yayin;
        $blog->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data=Blog::find($request->dataid)->delete();
        if($data){
            return 'success';
        }else{
            return 'error';
        }
    }
}
