@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Product List</h2>

        <!-- Button to Add New Product -->
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('add-product') }}" class="btn btn-primary">Add Product</a>

            <!-- Filter Inputs -->
            <div class="d-flex">
                <input type="text" id="search" class="form-control me-2" placeholder="Search" style="width: 200px;">
            </div>
        </div>
        <!-- Table displaying products -->
        <table class="table table-striped" id="product-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: '{{ route('products.data') }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = $('meta[name="csrf-token"]').attr(
                            'content');
                        d.search = $('#search').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            // Event listener for input changes to apply filtering
            $('#search').on('keyup change', function() {
                table.draw(); // Redraw table when filters change
            });
        });

        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: '/product/' + id, // Adjust the URL to match your route
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        $('#product-table').DataTable().ajax.reload(); // Reload the table
                        if (response.success) {
                            // Show success message
                            $('#message').html('<div class="alert alert-success">' + response.message +
                                '</div>');
                        } else {
                            // Show failure message
                            $('#message').html('<div class="alert alert-danger">' + response.message +
                                '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#message').html(
                            '<div class="alert alert-danger">Something went wrong. Please try again later.</div>'
                        );
                    }
                });
            }
        }

        // Function to handle adding a product to the cart
        function addToCart(id) {
            $.ajax({
                url: '/cart/add', // Adjust this route to add a product to the cart
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: id
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                    } else {
                        // Show failure message
                        $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#message').html(
                        '<div class="alert alert-danger">Something went wrong. Please try again later.</div>'
                    );
                }
            });
        }
    </script>
@endsection
