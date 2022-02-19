<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('backend.pages.users.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('backend.pages.users.new_edit_user', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3|email|unique:users,email',
            'image' => 'required|mimes:png,jpg,jpeg',
            'password' => 'required|confirmed|min:6'
        ]);

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->save();
        if ($request->hasFile('image')) {
            $avatarPath = $request->file('image');
            $avatarName = time() . '.' . $avatarPath->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('users_logo/' . $users->id, $avatarName, 'public');
            $userEdit=User::find($users->id);
            $userEdit->photo = $path;
            $userEdit->update();
        }
        $users->syncRoles($request->role);

        return redirect()->route('admin.users');
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
        $role = Role::all();
        $userDuzenle=User::find($id);
        return view('backend.pages.users.new_edit_user',compact('role','userDuzenle'));
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
        $users = User::find($id);
        if($request->has('password')&&$request->email===$users->email){
            $validate = $request->validate([
                'name' => 'required|min:3',
                'password' => 'confirmed'
            ]);
            $users->name = $request->name;
            $users->email = $request->email;
            if ($request->hasFile('image')) {
                Storage::delete('public/'.$users->photo);
                $avatarPath = $request->file('image');
                $avatarName = time() . '.' . $avatarPath->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('users_logo/' . Auth::id(), $avatarName, 'public');
                $users->photo = $path;
            }
            $users->password = bcrypt($request->password);
            $users->update();
            $users->syncRoles($request->role);

            return redirect()->route('admin.users');
        }elseif($request->email===$users->email){
            $validate = $request->validate([
                'name' => 'required|min:3',
                'role' => 'required',
            ]);
            $users->name = $request->name;
            $users->email = $request->email;
            if ($request->hasFile('image')) {
                Storage::delete('public/'.$users->photo);
                $avatarPath = $request->file('image');
                $avatarName = time() . '.' . $avatarPath->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('users_logo/' . Auth::id(), $avatarName, 'public');
                $users->photo = $path;
            }
            $users->update();
            $users->syncRoles($request->role);

            return redirect()->route('admin.users');
        }
        elseif($request->email!=$users->email){
            $validate = $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|min:3|email|unique:users,email',
                'role' => 'required',
            ]);
            $users->name = $request->name;
            $users->email = $request->email;
            if ($request->hasFile('image')) {
                Storage::delete('public/'.$users->photo);
                $avatarPath = $request->file('image');
                $avatarName = time() . '.' . $avatarPath->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('users_logo/' . $users->id, $avatarName, 'public');
                $users->photo = $path;
            }
            $users->update();
            $users->syncRoles($request->role);

            return redirect()->route('admin.users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy=User::find($id);
        Storage::delete('public/'.$destroy->photo);
        $destroy->delete();
        return 'success';
    }
}
