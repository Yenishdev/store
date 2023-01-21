<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show (Request $request, $slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->with(['category', 'brand'])
            ->orderBy('id', 'desc')
            ->paginage();

        return view('category.show')
            ->with([
                'category' => $category,
                'products' => $products
            ]);
    }
}
