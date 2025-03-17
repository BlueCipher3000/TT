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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedBigInteger('price');
            $table->integer('sale');
            $table->integer('hot');
            $table->text('description');
            $table->string('img');
            $table->text('content');
            $table->integer('status');
            $table->integer('total_pay');
            $table->integer('total_rating');
            $table->integer('total_stars');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
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
