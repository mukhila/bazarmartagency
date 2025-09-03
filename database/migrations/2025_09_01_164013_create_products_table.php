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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
              $table->string('name');
              $table->text('description')->nullable();
              $table->string('category');
              $table->enum('product_type', ['BOX', 'PKT'])->default('BOX');
            $table->string('brand')->nullable();
            $table->decimal('actual_price', 10, 2);
            $table->decimal('discounted_price', 10, 2)->nullable();


            $table->string('unit')->nullable();  // e.g. "500g Pack"
            $table->string('image')->nullable();
            $table->integer('content_per_container')->nullable();
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
