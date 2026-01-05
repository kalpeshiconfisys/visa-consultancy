<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaCategory extends Model
{

    protected $table = "visa_categories";

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image',
        'category_logo',
        'publish_is',
        'date_modified',
    ];

    public function getImageAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/visa-category/' . $value);
        }
        return null;
    }

    public function getCategoryLogoAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/category_logo/' . $value);
        }
        return null;
    }
}
