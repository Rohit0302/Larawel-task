<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('product_name', 50)->unique();  // Unique product name
            $table->decimal('price', 8, 2);  // Price as decimal, allowing up to 999999.99
            $table->integer('quantity');  // Quantity as integer (whole numbers only)
            $table->text('description')->nullable();  // Description, nullable if not always provided
            $table->timestamps();  // Created at & Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
