<?php

namespace App\Http\Controllers\Admin\VisaCategory;

use App\Http\Controllers\Controller;
use App\Models\VisaCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VisaCategoryController extends Controller
{
    // List all visa categories
    public function index()
    {
        $visaCategories  = VisaCategory::latest()->paginate(10);

        return view('admin.visa-category.index', compact('visaCategories'));
    }

    // Show create form
    public function create()
    {
        return view('admin.visa-category.create');
    }

    // Store new visa category
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "short_description" => "required",
            "description" => "required",
            "image" => "required|image|mimes:png,jpg,jpeg,webp",
            "publish_is" => "required"
        ]);

        $input = $request->only("title", "short_description", "description", "publish_is");

        $input['date_modified'] = Carbon::now()->toDateTimeString();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/visa-category'), $imgName);
            $input['image'] = $imgName;
        }

        if ($request->hasFile('category_logo')) {
            $file = $request->file('category_logo');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/category_logo'), $imgName);
            $input['category_logo'] = $imgName;
        }

        VisaCategory::create($input);

        return redirect()->route('admin.visa-category.index')->with('success', 'Visa Category Created Successfully');
    }

    // Show edit form
    public function edit($encodedId)
    {
        $id = base64_decode($encodedId);
        $visaCategory = VisaCategory::findOrFail($id);
        return view('admin.visa-category.edit', compact('visaCategory'));
    }

    // Update visa category
    public function update(Request $request, $encodedId)
    {
        $id = base64_decode($encodedId);
        $request->validate([
            "title" => "required",
            "short_description" => "required",
            "description" => "required",
            "publish_is" => "required"
        ]);

        $visa = VisaCategory::findOrFail($id);
        $input = $request->only("title", "short_description", "description", "publish_is");
        $input['date_modified'] = Carbon::now()->toDateTimeString();


        if ($request->hasFile('image')) {
            if ($visa->image && File::exists(public_path('uploads/visa-category/' . basename($visa->image)))) {
                File::delete(public_path('uploads/visa-category/' . basename($visa->image)));
            }

            $file = $request->file('image');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/visa-category'), $imgName);
            $input['image'] = $imgName;
        }

        if ($request->hasFile('category_logo')) {
            if ($visa->category_logo && File::exists(public_path('uploads/category_logo/' . basename($visa->category_logo)))) {
                File::delete(public_path('uploads/category_logo/' . basename($visa->category_logo)));
            }

            $file = $request->file('category_logo');
            $imgName = time() . rand(1000, 9999) . "." . $file->extension();
            $file->move(public_path('uploads/category_logo'), $imgName);
            $input['category_logo'] = $imgName;
        }

        $visa->update($input);
        return redirect()->route('admin.visa-category.index')->with('success', 'Visa Category Updated Successfully');
    }

    // Delete visa category
    public function destroy($encodedId)
    {
        $id = base64_decode($encodedId);
        $visa = VisaCategory::findOrFail($id);

        if (!empty($visa->image)) {
            $path = public_path('uploads/visa-category/' . basename($visa->image));
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        if (!empty($visa->category_logo)) {
            $path = public_path('uploads/category_logo/' . basename($visa->category_logo));
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $visa->delete();

        return redirect()->route('visa-category.index')->with('success', 'Visa Category Deleted Successfully');
    }

    // Optional: Show single visa category
    public function show($encodedId)
    {
        $id = base64_decode($encodedId);
        $visaCategory  = VisaCategory::findOrFail($id);

        return view('admin.visa-category.show', compact('visaCategory'));
    }
}
