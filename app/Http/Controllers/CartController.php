<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Yajra\DataTables\DataTables;

class CartController extends Controller
{
    public function card()
    {
        return view('card-list');
    }
    public function add(Request $request)
    {
        $CardAdd = Card::create([
            'product_id' => $request->input('product_id'),
            'user_id' => auth()->id(),
            'created_at' => now(),  // Include the timestamp for creation
        ]);
        if ($CardAdd) {
            return response()->json([
                'success' => true,
                'message' => 'Product has been added to your cart successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'There was an issue adding the product to your cart. Please try again.'
        ]);

    }
    public function CardList(Request $request)
    {
        if ($request->ajax()) {
            // Start building the query
            $cardsQuery = Card::with(['user', 'product']);  // Eager load user and product
            $userId = auth()->user()->id;  // Get the logged-in user's ID
            $cardsQuery->where('user_id', $userId);
            // Apply the search filter for the related product model (product_name and price)
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;

                // Use whereHas to filter on related product model (product_name and price)
                $cardsQuery->whereHas('product', function ($query) use ($search) {
                    $query->where('product_name', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%');
                });
            }

            // Execute the query and get the results
            $cards = $cardsQuery->get();  // Now execute the query after building it

            return DataTables::of($cards)
                ->addColumn('product_name', function ($row) {
                    return $row->product->product_name;  // Display the Product's name
                })
                ->addColumn('price', function ($row) {
                    return $row->product->price;  // Display the Product's price
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-danger btn-sm" onclick="deleteProduct(' . $row->id . ')"><i class="fas fa-trash"></i> Remove</button>';
                })
                ->make(true);
        }
    }
    public function destroy($id)
    {
        // Find the card by ID
        $card = Card::find($id);
        if ($card) {
            // Delete the card record
            $card->delete();
            // Return a success message
            return response()->json([
                'success' => true,
                'message' => 'Product Remove successfully.'
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
