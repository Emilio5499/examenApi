<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

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

}
