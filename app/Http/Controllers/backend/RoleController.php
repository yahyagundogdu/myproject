<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.dddddd
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role=Role::all();
        return view('backend.pages.role.role',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.role.new_edit_role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('rolkayit')){
            $validate=$request->validate([
                'name'=>'min:3|unique:role,name',
            ]);
            Role::create(['name'=>$request->name]);
            return redirect()->route('admin.role')->with('success', 'Rol Başrıyla eklendi');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolDuzenle=Role::find($id);
        return view('backend.pages.role.new_edit_role',compact('rolDuzenle'));
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
        $rol=Role::find($id);
        $rol->name=$request->name;
        $rol->update();
        return redirect()->route('admin.role')->with('success', 'Rol başarıyla güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy=Role::find($id)->delete();
        return 'success';
    }
}
