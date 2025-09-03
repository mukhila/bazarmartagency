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
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->default('General');
            $table->string('product_type')->default('BOX');
            $table->string('brand')->nullable();
            $table->decimal('actual_price', 10, 2)->default(0);
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->string('unit')->nullable();
            $table->string('image')->nullable();
            $table->string('content_per_container')->nullable();
            $table->softDeletes();
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
