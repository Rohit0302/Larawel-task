<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function productlist()
    {
        return view('product-list');
    }
    public function addproduct()
    {
        return view('add-product');
    }
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'product_name' => 'required|string',
            'description' => 'required|min:8|max:255',
            'price' => 'required|numeric|min:1',  // Ensure price is numeric and not negative
            'quantity' => 'required|numeric|min:1',  // Ensure price is numeric and not negative
        ];

        // Custom error messages
        $messages = [
            'product_name.required' => 'The product_name field is required.',
            'product_name.string' => 'The product_name must be a string.',

            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price number must be numeric.',
            'price.min' => 'The price must be at least 1.',

            'quantity.required' => 'The quantity field is required.',
            'quantity.numeric' => 'The quantity number must be numeric.',
            'quantity.min' => 'The quantity must be at least 1.',

            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least 8 characters.',
        ];
        // Validate request data
        $validatedData = $request->validate($rules, $messages);
        $ProductAdd = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);
        if ($ProductAdd) {
            return redirect()->route('product-list')->with('success', 'Product has been created successfully!');
        }
        return redirect()->route('product-list')->with('error', 'Product has been created unsuccessful!');

    }

    public function getData(Request $request)
    {
        // Check if it's an AJAX request
        if ($request->ajax()) {
            $data = Product::query();  // Query the Product model

            // Filter by product_name if the user has provided it in the request
            if ($request->has('search') && $request->search != '') {
                $data->where('product_name', 'like', '%' . $request->search . '%');
                $data->where('price', 'like', '%' . $request->search . '%');
            }
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<a href="product/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteProduct(' . $row->id . ')"><i class="fas fa-trash"></i> Delete</button>
                        <button class="btn btn-success btn-sm" onclick="addToCart(' . $row->id . ')"><i class="fas fa-cart-plus"></i> Add to Cart</button>';
                })
                ->make(true);
        }
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit-product', compact('product'));
    }
    public function update(Request $request, $id)
    {
        // Validation rules for the fields
        $rules = [
            'product_name' => 'required|string|max:255', // Max length is optional but good practice
            'description' => 'required|min:8|max:255',  // Keeping your description length constraints
            'price' => 'required|numeric|min:1',  // Ensure price is numeric and not negative
            'quantity' => 'required|numeric|min:1',  // Ensure price is numeric and not negative

        ];

        // Custom error messages for validation failures
        $messages = [
            'product_name.required' => 'The product name is required.',
            'product_name.string' => 'The product name must be a string.',
            'product_name.max' => 'The product name must not exceed 255 characters.',

            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a numeric value.',
            'price.min' => 'The price must be at least 1.',
            'quantity' => 'required|numeric|min:1',  // Ensure price is numeric and not negative

            'description.required' => 'The description is required.',
            'description.min' => 'The description must be at least 8 characters long.',
            'description.max' => 'The description must not exceed 255 characters.',
        ];

        // Validate the incoming request data
        $request->validate($rules, $messages);

        // Find the product by ID and update it
        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $res = $product->save();
        if ($res) {
            return redirect()->route('product-list')->with('success', 'Product has been updated successfully!');
        } else {
            return redirect()->route('product-list')->with('error', 'Product update failed, please try again.');
        }
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Delete the product record
            $product->delete();
            // Return a success message
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.'
            ]);
        } else {
            // Return an error message if card not found
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ]);
        }
    }

}
