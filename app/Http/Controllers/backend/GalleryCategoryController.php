<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\GaleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=GaleryCategory::all();
        return view('backend.pages.gallery.category_list',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.gallery.new_edit_category');
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
                'name=>required|min:3',
                'slug=>required|min:3'
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data=new GaleryCategory();
        $data->name=$request->name;
        $data->slug=$request->slug;
        $data->save();
        return redirect()->route('galeri-kategori.index');
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

        $kategoriDuzenle=GaleryCategory::find($id);
        return view('backend.pages.gallery.new_edit_category',compact('kategoriDuzenle'));
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
                'name=>required|min:3',
                'slug=>required|min:3'
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $kategoriDuzenle=GaleryCategory::find($id);
        $kategoriDuzenle->name=$request->name;
        $kategoriDuzenle->slug=$request->slug;
        $kategoriDuzenle->update();

        return redirect()->route('galeri-kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=GaleryCategory::find($id);
        $data->delete();
        if($data){
            return 'success';
        }
        else{
            return 'error';
        }
    }
}
