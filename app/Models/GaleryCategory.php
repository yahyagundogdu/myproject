<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleryCategory extends Model
{
    use HasFactory;
    protected $table='galery_category';

    public function getfirstimage()
    {
        $data=$this->belongsTo(Gallery::class,'id','category_id');
        return $data;
    }
}
