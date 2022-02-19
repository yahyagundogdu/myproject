<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\GaleryCategory;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos=Gallery::all();
        return view('backend.pages.gallery.galery_list',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=GaleryCategory::all();
        return view('backend.pages.gallery.new_edit_galery',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'category_id=>required',
                'path=>required|min:3',
                'type=>required',
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data=new Gallery();
        $data->category_id=intval($request->category_id);
        $data->path=$request->filepath;
        $data->type=$request->type;
        $data->video_path=$request->video_path;
        $data->save();
        return redirect()->route('galeri.index');
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
        $fotografDuzenle=Gallery::find($id);
        $category=GaleryCategory::all();
        return view('backend.pages.gallery.new_edit_galery',compact('fotografDuzenle','category'));
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
        $validator = Validator::make($request->all(),
            [
                'category_id=>required',
                'path=>required|min:3',
                'type=>required'
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data=Gallery::find($id);
        $data->category_id=intval($request->category_id);
        $data->path=$request->filepath;
        $data->type=$request->type;
        $data->video_path=$request->video_path;
        $data->update();
        return redirect()->route('galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $destroy=Gallery::find($request->dataid)->delete();
        if($destroy){
            return 'success';
        }
        return 'error';
    }
}
