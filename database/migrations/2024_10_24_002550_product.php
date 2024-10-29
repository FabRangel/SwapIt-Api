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
            $table->foreignId('id_user')->constrained('users');  
            $table->enum('category', ['ropa', 'electrónico', 'hogar', 'otros']); 
            $table->string('name', 100);  
            $table->text('description');  
            $table->boolean('is_new'); 
            $table->integer('funcionality')->check('funcionality BETWEEN 1 AND 5');  
            $table->string('image1', 255)->nullable();  
            $table->string('image2', 255)->nullable();  
            $table->string('image3', 255)->nullable();  
            $table->string('image4', 255)->nullable();  
            $table->string('image5', 255)->nullable();  
            $table->set('interest_categories', ['ropa', 'electrónico', 'hogar', 'otros']);  
            $table->enum('status', ['activa', 'en pausa', 'finalizada'])->default('activa'); 
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
