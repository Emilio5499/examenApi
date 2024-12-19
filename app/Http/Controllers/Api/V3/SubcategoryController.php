<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Str;
use App\Http\Controllers\SubcategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Product;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')
            ->select('name', 'description')
            ->$this->Category::name
            ->paginate(10);

        return view('subcategories.index', compact('subcategories'));
    }

    public function AuthIndex()
    {
        abort_if(! auth()->user()->tokenCan('Subcategories-list'), 403);

        $subcategories = Subcategory::with('category')
            ->select('name', 'description')
            ->$this->Category::name
            ->$this->Product::name(Product::all()->pluck('name'))
            ->paginate(12);

        return view('subcategories.index', compact('subcategories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::uuid() . '.' . $file->extension();
            $file->storeAs('categories', $name, 'public');
            $data['photo'] = $name;
        }

        $subcategory = Subcategory::create($data);

        return new SubcategoryResource($subcategory);
    }

    public function update(Subcategory $subcategory, StoreCategoryRequest $request)
    {
        $subcategory->update($request->all());

        return new SubcategoryResource($subcategory);
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        //return response(null, Response::HTTP_NO_CONTENT);
        return response()->noContent();
    }

}
