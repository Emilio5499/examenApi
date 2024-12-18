<?php

namespace App\Http\Controllers;

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

}
