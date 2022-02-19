<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','sub_page_id','sortable','active','dynamic'];

    public function children($id)
    {
        return Pages::where('sub_page_id','=',$id)->where('sub_page_id','!=',null)->orderBy('sortable')->get();
    }
}
