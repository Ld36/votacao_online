<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained()->onDelete('cascade');
            $table->foreignId('poll_option_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->string('token')->nullable();
            $table->timestamps();
            
            // Impede votos duplicados
            $table->unique(['poll_id', 'ip_address']);
            $table->unique(['poll_id', 'token']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
};