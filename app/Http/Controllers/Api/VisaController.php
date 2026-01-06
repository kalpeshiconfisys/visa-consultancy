<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisaCategory;
 

class VisaController extends Controller
{

    public function visa_cateory_list()
    {
        $visaCategories  = VisaCategory::latest()->paginate(10);
        return $this->success(true , 'Visa Category Data retrived successfully!',$visaCategories);
    }


}
