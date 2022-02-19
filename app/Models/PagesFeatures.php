<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesFeatures extends Model
{
    use HasFactory;
    protected $fillable = ['page_id','feature_description','feature_key','feature_value','feature_type','feature_delete'];

    protected $table="page_features";
}
