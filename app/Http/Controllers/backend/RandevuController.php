<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AppointmentData;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RandevuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AppointmentData::orderBy('created_at', 'desc')->paginate(30);
        return view('backend.pages.randevu.randevu_list', compact('data'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = AppointmentData::find($id);
        return view('backend.pages.randevu.randevu_view', compact('data'));
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
        $log = [];
        $validator = $request->validate([
            'log' => 'required',
        ]);
        $json_data[] = array('user' => Auth::user()->id, 'data' => $request->log, 'date' => now(), 'status' => $request->status);
        $data = AppointmentData::find($id);
        $database_log = json_decode($data->log);
        if ($data->log != null) {
            $data->log = json_encode(array_merge($database_log, $json_data), JSON_UNESCAPED_UNICODE);
        } else {
            $data->log = json_encode($json_data, JSON_UNESCAPED_UNICODE);
        }
        $data->status = $request->status;
        $data->update();
        return back()->with('success','Randevu talebiniz alınmıştır en kısa sürede sizlere dönüş yapacağız.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteData=AppointmentData::find($id);
        $deleteData->delete();
        return back();
    }
    public function search(Request $request)
    {

        $search = $request->search;
        $request->flash();
        $type=$request->type;
        $data = DB::table('appointment_data');
        if (isset($request->search)&&$request->search!=null) {
            $data =$data->where(function ($query) use ($search) {
                    $query=$query->where(DB::raw('lower(form_data)'),'LIKE', ['Adı'=>'%'.strtolower($search).'%']);
                    $query=$query->orWhere(DB::raw('lower(form_data)'),'LIKE', ['Soyadı'=>'%'.strtolower($search).'%']);
                    $query=$query->orWhere(DB::raw('lower(form_data)'),'LIKE', ['Telefon'=>'%'.strtolower($search).'%']);
                    $query=$query->orWhere(DB::raw('lower(form_data)'),'LIKE', ['Email'=>'%'.strtolower($search).'%']);
                });
        }
        if (isset($request->type)) {
            $data = $data->whereIn('status', $request->type);
        }
        if(!isset($request->type)&&!isset($request->search)&&$request->search==null){
            $data = AppointmentData::orderBy('created_at', 'desc')->paginate(30);
            return view('backend.pages.randevu.randevu_list', compact('data'));
        }
        $data = $data->orderBy('created_at', 'desc')->paginate(30);
        return view('backend.pages.randevu.randevu_list', compact('data','type'));
    }



}
