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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->boolean('gender');
            $table->date('birthday');
            $table->string('phone',10)->unique()->nullable();
            $table->string('email',50)->unique();
            $table->string('password',50);
            $table->text('address')->nullable();
            $table->string('img')->nullable();
            $table->integer('role');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
