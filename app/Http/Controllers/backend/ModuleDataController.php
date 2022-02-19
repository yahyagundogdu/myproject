<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ModuleBuilds;
use App\Models\ModuleDatas;
use Illuminate\Http\Request;

class ModuleDataController extends Controller
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
        $write = new ModuleDatas();
        $write->module_id = $request->id;
        foreach ($request->data as $data) {
            foreach ($data as $key => $enddata) {
                $decode=(object)$enddata;
                $write_data[] = array('data_type' => $key, 'data_value' => $decode->value);
            }
        }
        $write->data=json_encode($write_data,JSON_UNESCAPED_UNICODE);
        $write->save();
        return back()->with('success','Kayıt başarıyla eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module_body = ModuleBuilds::where('module_id', '=', $id)->orderBy('order')->get();
        $module_data = ModuleDatas::where('module_id', '=', $id)->get();
        $id = $id;
        return view('backend.pages.module.module_data', compact('module_body', 'id', 'module_data'));
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
    public function destroy($id)
    {
        $data = ModuleDatas::find($id)->destroy();
        return redirect(route('module-data.create'));
    }
}
