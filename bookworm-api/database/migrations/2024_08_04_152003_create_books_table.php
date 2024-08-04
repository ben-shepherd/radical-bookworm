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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('externalId', 100);
            $table->string('title', 1000)->nullable();
            $table->json('authors')->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('image', 1000)->nullable();
            $table->string('link', 1000)->nullable();
            $table->integer('rating')->default(0);
            $table->float('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
