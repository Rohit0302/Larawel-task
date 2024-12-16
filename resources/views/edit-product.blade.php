<!-- resources/views/edit-product.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Product</h2>

        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    placeholder="Enter Product name" value="{{ old('product_name', $product->product_name) }}">
                @error('product_name')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Enter Product Description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price"
                    placeholder="Enter Product Price" value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" step="0.01" class="form-control" id="quantity" name="quantity"
                    placeholder="Enter Product quantity" value="{{ old('quantity', $product->quantity) }}">
                @error('quantity')
                    <div class="error-mesage text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('product-list') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
