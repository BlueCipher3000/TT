<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',50)->unique();
            $table->mediumText('name');
            $table->boolean('gender')->nullable();
            /* $table->date('birthday');
            $table->string('phone',10)->unique()->nullable();
            $table->string('email',50)->unique(); */
            $table->string('password',50);
            // $table->text('address')->nullable();
            $table->string('img')->nullable();
            $table->unsignedTinyInteger('privilege');
            $table->boolean('status');
            $table->timestamps();
        });

        DB::table('users')->insert([
            'username' => 'root',
            'name' => 'Root',
            'gender' => null,
            'password' => 'root',
            'img' => 'default.png',
            'privilege' => 0,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        // DB::statement('ALTER TABLE users ADD CONSTRAINT chk_privilege CHECK (privilege >= 1 OR id = 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
