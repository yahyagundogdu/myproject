<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\PagesFeatures;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\React;
use Symfony\Component\Console\Input\Input;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::whereNull('sub_page_id')->orderBy('sortable')->get();
        return view('backend.pages.page.pages', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Pages::all();
        return view('backend.pages.page.new_edit_page', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->has('newPage')) {
            if($request->viewcontrol!=1){
                $request->flash();
                $validate = $request->validate([
                    'name' => 'required|min:3'
                ]);
                if ($request->slug != '#') {
                    $validate = $request->validate([
                        'slug' => 'required|unique:pages,slug'
                    ]);
                }
                $page = new Pages();
                $page->name = $request->name;
                if($request->viewcontrol!=1){
                    $page->slug = $request->slug != '#' ? Str::slug($request->slug) : '#';
                }else{
                    $page->slug = $request->slug != '#' ? $request->slug : '#';
                }
                $page->sub_page_id = $request->sub_page_id ? $request->sub_page_id : null;
                $page->active = $request->yayin;
                $page->urlcontrol = $request->viewcontrol;
                $page->save();
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'Başlık',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'baslik',
                    'feature_value' => '',
                    'feature_type' => 'text',
                    'feature_delete' => '0'
                ]);
                $newPage->save();
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'Sayfa Üst Başlığı',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'ustbaslik',
                    'feature_value' => '',
                    'feature_type' => 'text',
                    'feature_delete' => '0'
                ]);
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'Title',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'title',
                    'feature_value' => '',
                    'feature_type' => 'text',
                    'feature_delete' => '0'
                ]);
                $newPage->save();
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'Descrtiption',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'description',
                    'feature_value' => '',
                    'feature_type' => 'text',
                    'feature_delete' => '0'
                ]);
                $newPage->save();
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'Anahat Kelimeler',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'key',
                    'feature_value' => '',
                    'feature_type' => 'text',
                    'feature_delete' => '0'
                ]);
                $newPage->save();
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'İçerik',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'icerik',
                    'feature_value' => '',
                    'feature_type' => 'ckeditor',
                    'feature_delete' => '0'
                ]);
                $newPage->save();
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'Sayfa Üst Resmi',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'ustresim',
                    'feature_value' => '',
                    'feature_type' => 'image',
                    'feature_delete' => '0'
                ]);
                $newPage->save();
                $newPage = PagesFeatures::create([
                    'page_id' => $page->id,
                    'feature_description' => 'Resim',
                    'feature_key' => mb_convert_case(Str::slug($request->name), MB_CASE_LOWER, "UTF-8") . '.' . 'resim',
                    'feature_value' => '',
                    'feature_type' => 'image',
                    'feature_delete' => '0'
                ]);
                $newPage->save();
                return back();
            }
            else{
                $request->flash();
                $validate = $request->validate([
                    'name' => 'required|min:3'
                ]);
                if ($request->slug != '#') {
                    $validate = $request->validate([
                        'slug' => 'required|unique:pages,slug'
                    ]);
                }
                $page = new Pages();
                $page->name = $request->name;
                if($request->viewcontrol!=1){
                    $page->slug = $request->slug != '#' ? Str::slug($request->slug) : '#';
                }else{
                    $page->slug = $request->slug != '#' ? $request->slug : '#';
                }
                $page->sub_page_id = $request->sub_page_id ? $request->sub_page_id : null;
                $page->active = $request->yayin;
                $page->urlcontrol = $request->viewcontrol;
                $page->save();
            }
            return back();
        }


        if ($request->has('newPageSettings')) {
            $pageName = Pages::find($request->pageid);
            $validated = $request->validate([
                'description' => 'required|min:3',
                'key' => 'required|min:3',
                'dosya_tipi' => 'required',
                'sil' => 'required'
            ]);
            $data = PagesFeatures::create([
                'page_id' => $request->pageid,
                'feature_description' => ucwords($request->description),
                'feature_key' => mb_convert_case(Str::slug($pageName->name), MB_CASE_LOWER, "UTF-8") . '.' . $request->key,
                'feature_value' => $request->value,
                'feature_type' => $request->dosya_tipi,
                'feature_delete' => $request->sil
            ]);
            $data->save();
            return back();
        }

        if ($request->has('allFeatureData')) {

            $data_array = $request->all();
            unset($data_array["_token"]);
            unset($data_array["pagesettings"]);
            unset($data_array["image"]);
            foreach ($data_array as $key => $value) {
                PagesFeatures::where('id', '=', $key)->update(['feature_value' => $value]);
            }
            $dizi=array();
            $files =$request->file('image');
            if ($request->hasFile('image')) {
                $sayac=0;
                foreach ($files as $key => $value) {
                    $settings = PagesFeatures::where('id', $key)->first();
                    $avatarPath = $value;
                    $dizi []=$avatarPath->getClientOriginalName();
                    $avatarName = time()+$sayac . '.' . $avatarPath->getClientOriginalExtension();
                    $path = $value->storeAs('pages', $avatarName, 'public');
                    $settings->feature_value = $path;
                    $settings->update();
                    Storage::delete($settings->feature_value);
                    $sayac++;
                }
                $sayac=0;
            }
            return back();
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
        $pageData = PagesFeatures::where('page_id', '=', $id)->get();
        $id = $id;
        return view('backend.pages.page.new_edit_page_feature', compact('pageData', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sayfaDuzenle = Pages::find($id);
        $pages = Pages::all();
        return view('backend.pages.page.new_edit_page', compact('sayfaDuzenle', 'pages'));
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
        if ($request->has('newPage')) {
            $validate = $request->validate([
                'name' => 'required|min:3',
            ]);
            if ($request->slug != '#') {
                $validate = $request->validate([
                    'slug' => 'required|min:1|unique:pages,slug,' . $id
                ]);
            }

            $page = Pages::find($id);
            $page->name = $request->name;
            if($request->viewcontrol!=1){
                $page->slug = $request->slug != '#' ? Str::slug($request->slug) : '#';
            }else{
                $page->slug = $request->slug != '#' ? $request->slug : '#';
            }
            $page->sub_page_id = $request->sub_page_id ? $request->sub_page_id : null;
            $page->active = $request->yayin;
            $page->urlcontrol = $request->viewcontrol;
            $page->update();
            $find=PagesFeatures::where('page_id','=',$page->id)->get();
            foreach($find as $data){
                $replacedata=PagesFeatures::find($data->id);
                $replacedata->feature_key=Str::slug($request->slug).'.'.ltrim(strpbrk($data->feature_key , "." ),'.');
                $replacedata->update();
            }
        }
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
        $destroy = Pages::find($id)->delete();
        return 'success';
    }

    public function deletefile(Request $request)
    {
        $data = PagesFeatures::where('id', $request->dataid)->first();
        $data->feature_value = null;
        $data->update();
        Storage::delete($request->datavalue);
        return 'success';
    }

    public function featureDelete(Request $request)
    {
        $destroy = PagesFeatures::find($request->dataid)->delete();
        return 'success';
    }
    public function featureDeleteImage(Request $request)
    {
        $destroy = PagesFeatures::find($request->dataid);
        $destroy->feature_value=null;
        $destroy->update();
        Storage::delete($destroy->datavalue);
        return 'success';
    }
    public function deleteAllFeature(Request $request)
    {
        $destroy = PagesFeatures::where('page_id', '=', $request->dataid)->delete();
        return 'success';
    }

    public function sortableView(Request $request)
    {
        $pages = Pages::whereNull('sub_page_id')->orderBy('sortable')->get();
        return  view('backend.pages.page.sortable_view', compact('pages'));
    }

    public function sortableSave(Request $request)
    {
        $returnData = array();
        $sortableData = $request->data;
        foreach ($sortableData as $datakey => $value) {
            $data = Pages::find($value['id']);
            $data->sortable = $datakey;
            $data->sub_page_id = null;
            $data->update();
            if(array_key_exists("children",$value)){
                foreach ($value['children'] as $key => $cData) {
                    $data = Pages::find($cData['id']);
                    $data->sortable = $key;
                    $data->sub_page_id = $value['id'];
                    $data->update();
                }
            }

        }
        return 'success';
    }
}
