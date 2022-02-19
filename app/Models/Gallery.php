<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table='galery';

    public function getcategory()
    {
        return $this->belongsTo(GaleryCategory::class,'category_id','id');
    }
}
