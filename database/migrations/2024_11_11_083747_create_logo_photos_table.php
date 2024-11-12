<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('logo_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logo_id')->constrained('logos')->onDelete('cascade'); // Foreign key to the logos table
            $table->string('path'); // Path to the photo file
            $table->enum('theme', ['Primary', 'White']); // Theme for the logo photo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_photos');
    }
};
