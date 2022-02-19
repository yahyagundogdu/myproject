<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AyarlarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datasite = Settings::where('group', '=', 'site')->orderBy('settings_order')->get();
        $dataadmin = Settings::where('group', '=', 'admin')->orderBy('settings_order')->get();
        return view('backend.pages.settings.settings', compact('dataadmin', 'datasite'));
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
        if ($request->has('yeniayar')) {
            $validated = $request->validate([
                'description' => 'required|min:3',
                'value' => 'required|min:3',
                'key' => 'required|unique:settings,settings_key|min:3',
                'dosya_tipi' => 'required',
                'group' => 'required',
            ]);
            $data = Settings::create([
                'settings_description' => ucwords($request->description),
                'settings_key' => $request->key,
                'settings_value' => $request->value,
                'settings_type' => $request->dosya_tipi,
                'group' => $request->group
            ]);
            $data->save();
            return back()->with($validated);
        }

        if ($request->has('site')) {
            $data_array = $request->all();
            unset($data_array["_token"]);
            unset($data_array["site"]);
            unset($data_array["image"]);
            foreach ($data_array as $key => $value) {
                Settings::where('id', '=', $key)->update(['settings_value' => $value]);
            }
            if ($request->hasFile('image')) {
                $request->file('image');
                $sayac=0;
                foreach ($request->file('image') as $key => $value) {
                    $settings = Settings::where('id', $key)->first();
                    $avatarPath = $value;
                    $avatarName = time()+$sayac . '.' . $avatarPath->getClientOriginalExtension();
                    $path = $value->storeAs('settings/' . Auth::id(), $avatarName, 'public');
                    $settings->settings_value = $path;
                    $settings->update();
                    Storage::delete($settings->datavalue);
                }
                $sayac=0;
            }

            return back();
        }
        if ($request->has('admin')) {
            $data_array = $request->all();
            unset($data_array["_token"]);
            unset($data_array["site"]);
            unset($data_array["image"]);
            foreach ($data_array as $key => $value) {
                Settings::where('id', '=', $key)->update(['settings_value' => $value]);
            }
            if ($request->hasFile('image')) {
                $sayac=0;
                foreach ($request->file('image') as $key => $value) {
                    $settings = Settings::where('id', $key)->first();
                    $avatarPath = $value;
                    $avatarName = time()+$sayac . '.' . $avatarPath->getClientOriginalExtension();
                    $path = $value->storeAs('settings/' . Auth::id(), $avatarName, 'public');
                    $settings->settings_value = $path;
                    $settings->update();
                    Storage::delete($settings->datavalue);
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
    public function destroy(Request $request, $id)
    {
        $destroy = Settings::find($id);
        $destroy->delete();
        return back();
    }

    public function delete($id)
    {
        $destroy = Settings::find($id);
        $destroy->delete();
        return back();
    }

    public function sortablesettings(Request $request)
    {
        foreach ($request->data as $key => $value) {
            Settings::where('id', '=', $value)->update(['settings_order' => $key]);
        }
    }

    public function deletefile(Request $request)
    {
        $data = Settings::where('id', $request->dataid)->first();
        $data->settings_value = null;
        $data->update();

        Storage::delete($request->datavalue);

        return 'success';
    }

}
