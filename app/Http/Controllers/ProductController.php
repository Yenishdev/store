<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])
            ->orderBy('id', 'desc')
            ->paginate();

        return view('product.index')
            ->with([
               'products' => $products,
            ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['category', 'brand'])
            ->firstOrFail();

        if(Cookie::has('product_views')) {
            $productIds = explode(',', Cookie::get('product_views'));
            if(!in_array($product->id, $productIds)){
                $product->increment('viewed');
                $productIds[] = $product->id;
                Cookie::queue('product_views', implode(',', $productIds), 60 * 8);
            }
            else{
                $product->increment('viewed');
                Cookie::queue('product_views', $product->id, 60 * 8);
            }
            return view('product.show')
                ->with([
                    'product' => $product,
                ]);
        }
    }

    public function create()
    {
        $categories = Category::orderBy('slug')
            ->get();
        $brands = Brand::orderBy('slug')
            ->get();

        return view('product.create')
            ->with([
                'categories' => $categories,
                'brands' => $brands,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|min:1',
            'brand' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg|max:1024|dimensions:width=600,height=800',
        ]);

        $product = new Product();
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->name = $request->name;
        $product->slug = str($request->name)->slug();
        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        if ($request->has('image')) {
            // name
            $name = 'photo-' . $product->id . '.jpg';
            // save normal size
            Storage::putFileAs('public/products', $request->image, $name);
            // save sm size
            $img = Image::make($request->image);
            $img->resize(135, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('storage/products/sm/' . $name);
            // save to modal
            $product->image = $name;
            $product->update();
        }

        return redirect('products.show', $product->slug)
            ->with([
                'success' => 'Product created',
            ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('slug')
            ->get();
        $brands = Brand::orderBy('slug')
            ->get();

        return view('product.edit')
            ->with([
                'product' => $product,
                'categories' => $categories,
                'brands' => $brands,
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|integer|min:1',
            'brand' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg|max:1024|dimensions:width=600,height=800',
        ]);

        $product = new Product();
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->name = $request->name;
        $product->slug = str($request->name)->slug();
        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if ($request->has('image')) {
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
                Storage::delete('public/products/sm/' . $product->image);
            }
            // name
            $name = 'photo-' . $product->id . '.jpg';
            // save normal size
            Storage::putFileAs('public/products', $request->image, $name);
            // save sm size
            $img = Image::make($request->image);
            $img->resize(135, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('storage/products/sm/' . $name);
            // save to modal
            $product->image = $name;
            $product->update();
        }
        $product->update();

        return redirect()->route('products.show', $product->slug)
            ->with([
                'success' => 'Product updated!',
            ]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if($product->image){
            Storage::delete('public/products/' . $product->image);
            Storage::delete('public/products/sm/' . $product->image);
        }
        $product->delete();

        return to_route('home')
            ->with([
                'success' => 'Product deleted'
            ]);
    }
    }

