<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fullName', 30)->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->string('profileImage')->nullable();
            $table->string('profileImage_Mime')->nullable();
            $table->integer('profileImage_Size')->nullable();
            $table->string('city', 20)->nullable();
            $table->string('address', 25)->nullable();
            $table->decimal('totalRevenue')->default(0);
            $table->integer('custumersNumber')->default(0);
            $table->rememberToken();
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
    public function users()
    {
        return $this->belongsToMany(User::class, 'product_user', 'product_id', 'user_id');
    }
};
