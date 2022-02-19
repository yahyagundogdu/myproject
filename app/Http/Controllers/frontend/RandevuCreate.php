<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\AppointmentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RandevuCreate extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $array['ip'] = $request->ip();
        $dataform = $request->data;
        array_push($dataform, $array);
        $data = new AppointmentData();
        $data->data_location = $request->formPath;
        $data->form_data = json_encode($dataform, JSON_UNESCAPED_UNICODE);
        $data->status = '0';
        $data->save();
        return back()->with('success','Randevu talebiniz alınmıştır en kısa sürede sizlere dönüş yapacağız.');
    }
}
