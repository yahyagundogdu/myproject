<?php

namespace App\Helpers;

use App\Models\ModuleDatas;
use App\Models\Pages;
use App\Models\PagesFeatures;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Helper{

    public static function is_active($url, $className='active'){
        return request()->is($url)?$className:null;
    }

    public static function menu_open($url, $className='menu-is-opening menu-open'){
        return request()->is($url)?$className:null;
    }
    public static function merhaba(){
        return "merhaba";
    }

    public static function setting($value){
        $find=Settings::where('settings_key','=',$value)->first();
        return $find->settings_value;
    }


    public static function site($value,$id){
        $page=Pages::find($id);
        $search=strval($page->slug.'.'.$value);
        $find=PagesFeatures::where('feature_key','=',$search)->first();
        return $find['feature_value'];
    }

    public static function siteItem($value){
        $find=PagesFeatures::where('feature_key','=',$value)->first();
        return $find['feature_value'];
    }
    public static function count($value){
        return DB::table($value)->count();
    }

    public static function Menu(){
        $menu=Pages::where('active','=','1')->orderBy('sortable')->get();
        return view('frontend.include.menu',compact('menu'));
    }

    public static function Call(){
        $call = ModuleDatas::where('module_id', '=', 6)->get();
        return view('frontend.page.call_section',compact('call'));
    }

    public static function paginator($paginator)
    {
        return view('backend.pages.paginate.paginator',compact($paginator));
    }
}

?>
