<?php

namespace App\Http\Controllers\Admin\VisaCategory;

use App\Http\Controllers\Controller;
use App\Models\VisaCategory;
use App\Models\VisaSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisaSubCategoryController extends Controller
{
    // List
    public function index()
    {
        $subCategories = VisaSubCategory::with('category')->latest()->paginate(10);
        return view('admin.visa-sub-category.index', compact('subCategories'));
    }

    // Create Page
    public function create()
    {
        $categories = VisaCategory::all();
        return view('admin.visa-sub-category.create', compact('categories'));
    }


    // STORE MULTIPLE
    public function store(Request $request)
    {
        $request->validate([
            "category_id"   => "required|exists:visa_categories,id",
            "title"         => "required|array",
            "title.*"       => "required|string|max:255",
            "description"   => "nullable|array",
            "publish_is"    => "required|in:1,2"
        ]);

        foreach($request->title as $key => $value){
            VisaSubCategory::create([
                "category_id" => $request->category_id,
                "title"       => $request->title[$key],
                "description" => $request->description[$key] ?? null,
                "bullets"     => isset($request->bullets[$key]) ? json_encode($request->bullets[$key]) : null,
                "publish_is"  => $request->publish_is,
                'content_type' => $request->content_type,
                'date_modified' => Carbon::now()->toDateTimeString(),
            ]);
        }

        return redirect()->route('admin.visa-sub-category.index')->with('success', 'Visa Sub Categories Added Successfully');
    }


    // EDIT PAGE — multiple
    public function edit($category_id)
    {

        $id = base64_decode($category_id);
        $categories = VisaCategory::all();

        $subCategories = VisaSubCategory::where('id',$id)->first();

        // if($subCategories->count() == 0){
        //     return back()->with('error','No Sub Categories Found For This Category');
        // }


        return view('admin.visa-sub-category.edit', compact('categories','subCategories'));
    }


    // UPDATE MULTIPLE
    public function update(Request $request)
    {
        $request->validate([
            "category_id" => "required|exists:visa_categories,id",
            "id"          => "required|array",
            "title.*"     => "required|string|max:255",
            "publish_is"  => "required|in:1,2"
        ]);

        foreach($request->id as $key=>$subId){
            $sub = VisaSubCategory::find($subId);
            if($sub){
                $sub->update([
                    "category_id" => $request->category_id,
                    "title"       => $request->title[$key],
                    "description" => $request->description[$key] ?? null,
                    "bullets"     => isset($request->bullets[$key])
                                        ? json_encode($request->bullets[$key])
                                        : null,
                    "publish_is"  => $request->publish_is,
                    'content_type' => $request->content_type,
                     'date_modified' => Carbon::now()->toDateTimeString(),
                ]);
                if($request->content_type == 'description'){
                   $sub->bullets = NULL;
                   $sub->save();

                }
                if($request->content_type == 'bullets'){
                    $sub->description = NULL;
                    $sub->save();
                }
            }
        }

        return redirect()
            ->route('admin.visa-sub-category.index')
            ->with('success','Visa Sub Categories Updated Successfully');
    }


    // DELETE SINGLE
    public function destroy($id)
    {
         $id = base64_decode($id);
        $sub = VisaSubCategory::findOrFail($id);
        $sub->delete();

        return redirect()
            ->route('admin.visa-sub-category.index')
            ->with('success', 'Visa Sub Category Deleted Successfully');
    }

    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $visaSubCategory  = VisaSubCategory::findOrFail($id);

        return view('admin.visa-sub-category.show', compact('visaSubCategory'));
    }

}
