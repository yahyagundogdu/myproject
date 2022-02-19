<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider=Slide::orderBy('sortable')->get();
        return view('backend.pages.slides.slides',compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.slides.new_edit_slides');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->flash();
        $validate=$request->validate([
            'filepath' => 'required|min:3',
        ]);
        $blog=new Slide();
        $blog->photo=$request->filepath;
        $blog->title=$request->title;
        $blog->subtext=$request->subtext;
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
        $sliderDuzenle=Slide::find($id);
        return view('backend.pages.slides.new_edit_slides',compact('sliderDuzenle'));
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
        $validate=$request->validate([
            'filepath' => 'required|min:3',
        ]);
        $blog=Slide::find($id);
        $blog->photo=$request->filepath;
        $blog->title=$request->title;
        $blog->subtext=$request->subtext;
        $blog->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy=Slide::find($id)->delete();
        return 'success';
    }

    public function sortablesettings(Request $request)
    {
        foreach ($request->data as $key => $value) {
            Slide::where('id', '=', substr($value,7))->update(['sortable' => $key]);
        }

    }
}
