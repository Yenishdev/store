@extends('layouts.app')
@section('title')
    {{$brand->name}}
@endsection
@section('content')
    <div class="container-lg py-3">
        <div class="h3 mb-3">
            <span class="text-secondary">Brand</span> {{$brand->name}}
        </div>
        <div class="row g-3 mb-3">
            @foreach($products as $product)
                <div class="col-6 col-md-4">
                    @include('app.product')
                </div>
            @endforeach
        </div>
        {{$products->links()}}
    </div>
    @endsection