<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ModuleBuilds;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class ModulesMakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module_array=array();
        $module_array['module_description']=$request->description;
        $module_array['module_type']=$request->module_element_type;
        $data=new ModuleBuilds();
        $data->module_id=$request->id;
        $data->module_form=json_encode($module_array, JSON_UNESCAPED_UNICODE);
        $data->save();
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
        $id=$id;
        $module_body=ModuleBuilds::where('module_id','=',$id)->orderBy('order')->get();
        return view('backend.pages.module.module_form_body',compact('id','module_body'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $destroy=ModuleBuilds::find($request->dataid)->delete();
        if($destroy){
            return 'success';
        }
        return 'error';

    }

    public function moduleSortable(Request $request){
        foreach ($request->data as $key => $value) {
            ModuleBuilds::where('id', '=', $value)->update(['order' => $key]);
        }
        return  $request->all();
    }
}
