<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function getcategory()
    {
        return $this->belongsTo(BlogCategory::class,'category_id','id');
    }

    public function arttirma($slug){

    }
}
