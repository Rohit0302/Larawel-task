<!-- resources/views/add-product.blade.php -->

@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add New Product</h2>

        <form action="{{ route('store-product') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="{{ old('product_name') }}" placeholder="Enter Product name">
                @error('product_name')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Enter Product Description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" id="price" name="price"
                    placeholder="Enter Product price" value="{{ old('price') }}">
                @error('price')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" id="quantity" name="quantity"
                    value="{{ old('quantity') }}" placeholder="Enter Product Quantity">
                @error('quantity')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Save Product</button>
            <a href="{{ route('product-list') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
