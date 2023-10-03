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
            $table->id()->primaryKey();
            $table->string('state', 20)->nullable();
            $table->date('dateOrder')->nullable();
            $table->decimal('quantity', 5)->nullable();
            $table->string('paymentMethod');
            $table->string('deliveryMethod');
            $table->unsignedInteger('totalPrice')->nullable();
            $table->foreignIdFor(User::class,'orderBy');
            $table->foreignIdFor(Product::class,'productOrdered');
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
