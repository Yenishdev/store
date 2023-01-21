<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)
            ->firstOrFail();
        $products = Product::where('brand_id', $brand->id)
            ->with(['category', 'brand'])
            ->orderBy('id', 'desc')
            ->paginate();

        return view('brand.show')
            ->with([
                'brand' => $brand,
                'products' => $products,
            ]);
    }
}
