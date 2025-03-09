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
            $table->increments('id');
            $table->string('name',100);
            $table->integer('price');
            $table->integer('sale');
            $table->integer('hot');
            $table->string('discribe',100);
            $table->string('img');
            $table->text('content');
            $table->integer('status');
            $table->integer('toyal_pay');
            $table->integer('total_rating');
            $table->integer('total_stars');
            $table->integer('category_id');
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
