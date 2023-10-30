<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_user', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['product_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_user');
    }
}