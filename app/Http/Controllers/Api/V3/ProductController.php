<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Api\V1\StoreProductRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(9);

        return ProductResource::collection($products);
    }

    public function update(Product $product, StoreProductRequest $request)
    {
        abort_if(! auth()->user()->tokenCan('product-list'), 403);

        $product->update($request->all());

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        abort_if(! auth()->user()->tokenCan('product-list'), 403);

        $product->delete();

        //return response(null, Response::HTTP_NO_CONTENT);
        return response()->noContent();
    }

}
