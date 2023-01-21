@extends('layouts.app')
@section('title')
    Add Product
    @endsection
@section('content')
<div class="container-lg py-3">
    <div class="h3 text-center mb-3">
        App Product
    </div>
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center">
            <div class="col-lg-6 mb-3">
                <label for="category" class="form-label fw-semibold">Category *</label>
                <select name="category" id="category" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="brand" class="form-label fw-semibold">Brand *</label>
                <select name="brand" id="brand" class="form-select" required>
                    @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="name" class="form-label fw-semibold">Name *</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="barcode" class="form-label fw-semibold">Barcode</label>
                <input type="text" name="barcode" id="barcode" class="form-control">
            </div>
            <div class="col-lg-12 mb-3">
                <label for="description" class="form-labelfw-semibold">Description</label>
                <textarea name="description" class="form-control" id="description"  rows="2"></textarea>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="price" class="form-label fw-semibold">Price *</label>
                <input type="number" class="form-control" name="price" id="price" min="0" step="0.1" value="0" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="stock" class="form-label fw-semibold">Stock *</label>
                <input type="number" name="stock" id="stock" min="0" value="0" class="form-control" required>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="image" class="form-label fw-semibold">Image *</label>
                <input type="file" accept="image/jpeg" class="form-control" name="image" id="image" required>
            </div>
        </div>
        <button class="btn btn-primary btn-sm w-100">
            Save
        </button>
    </form>
</div>
@endsection