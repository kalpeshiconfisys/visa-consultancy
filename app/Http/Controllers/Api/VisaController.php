<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VisaCategory;
use App\Models\VisaSubCategory;

class VisaController extends Controller
{

    public function visa_cateory_list()
    {
        $visaCategories  = VisaCategory::where('publish_is',2)->latest()->paginate(10);
        return $this->success(true , 'Visa Category Data retrived successfully!',$visaCategories);
    }

    public function visa_sub_cateory_list($visaCategoryId)
    {
        $visaSubCategories  = VisaSubCategory::where('category_id', $visaCategoryId)->where('publish_is',2)->latest()->paginate(10);
        return $this->success(true , 'Visa Sub Category Data retrived successfully!',$visaSubCategories);
    }
     


}
