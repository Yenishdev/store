@extends('layouts.app')
@section('title')
    Products
    @endsection
@section('content')
    <div class="container-lg py-3">
        <div class="h3 mb-3">
            Products
        </div>
        <div class="row g-3 mb-3">
            @foreach($products as  $product)
                <div class="col-6 col-md-4">
                    @include('app.product')
                </div>
                @endforeach
        </div>
        {{$products->onEachSide(2)->links()}}
    </div>
    @endsection