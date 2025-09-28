<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ชื่อสินค้า
            $table->text('description')->nullable(); // รายละเอียด
            $table->decimal('price', 8, 2); // ราคา
            $table->string('image')->nullable(); // รูปสินค้า
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
