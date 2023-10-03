<?php

use App\Models\Category;
use App\Models\User;
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
            $table->string('name', 20)->nullable();
            $table->integer('price')->nullable();
            $table->longText('description')->nullable();
            $table->string('profileImage', 2000)->nullable();
            $table->string('profileImage_Mime', 255)->nullable();
            $table->integer('profileImage_Size')->nullable();
            $table->foreignIdFor(Category::class,'category')->nullable();
            $table->decimal('rating', 10, 2)->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->integer('sold')->nullable();
            $table->foreignIdFor(User::class,'createdBy')->nullable();
            $table->foreignIdFor(User::class,'updatedBy')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreignIdFor(User::class,'deletedBy')->nullable();
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
