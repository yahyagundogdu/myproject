<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=BlogCategory::all();
        return view('backend.pages.blog.blog_category',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.blog.blog_category_new_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('blogkayit')){
            $validate=$request->validate([
                'name'=>'min:3|unique:blog_category,category_name',
            ]);
            $category=new BlogCategory();
            $category->category_name=$request->name;
            $category->save();
            return redirect()->route('admin.category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoriDuzenle=BlogCategory::find($id);
        return view('backend.pages.blog.blog_category_new_edit',compact('kategoriDuzenle'));
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

        if($request->has('blogkayit')){
            $category=BlogCategory::find($id);
            $validate=$request->validate([
                'name'=>'min:3|unique:blog_category,category_name,'.$category->id,
            ]);
            $category->category_name=$request->name;
            $category->update();
            return redirect()->route('admin.category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryFind=Blog::where('category_id','=',$id)->first();
        if($categoryFind==null){
            $categoryDelete=BlogCategory::find($id)->delete();
            return 'success';
        }else{
            return 'error';
        }

    }
}
