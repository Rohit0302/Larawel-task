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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');

            // Foreign key to 'users' table
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Foreign key to 'products' table
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
