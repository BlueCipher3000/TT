<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Always linked to an order
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Ensure product exists
            $table->string('product_name');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('final_price')->default(0); // Ensuring valid pricing
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
