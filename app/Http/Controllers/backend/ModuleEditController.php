<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ModuleBuilds;
use App\Models\ModuleDatas;
use Illuminate\Http\Request;

class ModuleEditController extends Controller
{
    public function editData(Request $request,$id)
    {
        $modul=ModuleDatas::find($id);
        $module_body=ModuleBuilds::where('module_id','=',$modul->module_id)->orderBy('order')->get();
        return view('backend.pages.module.module_data_edit',compact('modul','id','module_body'));
    }
    public function updateData(Request $request, $id)
    {
        $write=ModuleDatas::find($id);
        foreach ($request->data as $data) {
            foreach ($data as $key => $enddata) {
                $decode=(object)$enddata;
                $write_data[] = array('data_type' => $key, 'data_value' => $decode->value);
            }
        }
        $write->data=json_encode($write_data,JSON_UNESCAPED_UNICODE);
        $write->update();
        return back();
    }

    public function deleteData($id)
    {
        $write=ModuleDatas::find($id);
        $write->delete();
        return back();
    }
}
