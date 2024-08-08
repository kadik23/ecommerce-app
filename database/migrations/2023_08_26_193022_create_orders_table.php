<?php
use App\Models\Product;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('state', 20)->default('processing');
            $table->date('dateOrder')->nullable();
            $table->decimal('quantity', 5, 2)->nullable();
            $table->string('paymentMethod', 255);
            $table->string('deliveryMethod', 255);
            $table->foreignIdFor(User::class, 'orderBy');
            $table->foreignIdFor(Product::class, 'productOrdered');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
