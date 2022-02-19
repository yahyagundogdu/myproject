<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ModuleDatas;
use App\Models\PagesFeatures;
use Illuminate\Http\Request;
use stdClass;

class EkipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feature = PagesFeatures::where('page_id', '=', 8)->get();
        $page=new stdClass();
        foreach ($feature as $key => $value) {
            $page->{
                ltrim(strpbrk($value['feature_key'] , "." ),'. ')} = $value['feature_value'];
        }
        $data = ModuleDatas::where('module_id', '=', 2)->get();
        return view('frontend.page.ekibimiz',compact('data','page'));
    }

    function show($id)
    {
        $data = ModuleDatas::find($id);
        return view('frontend.page.single_ekip',compact('data'));
    }
}
