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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('id_user')->constrained('users');  
            $table->enum('message_type', ['aceptado', 'rechazado', 'ofertas']); 
            $table->text('description')->nullable();; 
            $table->boolean('seen')->default(false);  
            $table->timestamp('date_message')->useCurrent(); 
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
