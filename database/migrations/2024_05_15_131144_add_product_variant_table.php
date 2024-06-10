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
        Schema::table('product_variant', function (Blueprint $table) {
          $table->unsignedBigInteger('product_id')->nullable();
          $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
          $table->string('origin')->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant');
    }
};
