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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('id_product')->constrained('products');  
            $table->foreignId('id_user_offer')->constrained('users');  
            $table->foreignId('id_product_offered')->constrained('products'); 
            $table->enum('status_offer', ['aceptado', 'rechazado', 'en curso'])->default('en curso'); 
            $table->timestamp('offer_date')->useCurrent(); 
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
