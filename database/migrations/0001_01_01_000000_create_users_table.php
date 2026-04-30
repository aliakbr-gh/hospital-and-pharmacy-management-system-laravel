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
            $table->id()->comment('Primary key');

            $table->string('username')->unique()->comment('Login username for staff');
            $table->string('password')->comment('Hashed password');

            $table->string('phone')->nullable()->comment('Contact number of staff');
            $table->enum('role', ['reception', 'pharmacy', 'admin'])
                ->comment('Defines system access level');

            $table->boolean('is_active')->default(true)
                ->comment('User active/inactive status');

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
