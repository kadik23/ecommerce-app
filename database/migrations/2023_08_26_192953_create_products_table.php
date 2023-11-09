<?php
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->nullable();
            $table->integer('price')->nullable();
            $table->longText('description')->nullable();
            $table->string('profileImage', 2000)->nullable();
            $table->foreignIdFor(Category::class, 'category')->nullable();
            $table->decimal('rating', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('sold', 3, 2)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreignIdFor(User::class, 'createdBy')->nullable();
            $table->foreignIdFor(User::class, 'updatedBy')->nullable();
            $table->foreignIdFor(User::class, 'deletedBy')->nullable();
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
