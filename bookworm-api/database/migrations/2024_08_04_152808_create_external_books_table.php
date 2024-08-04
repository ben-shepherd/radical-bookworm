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
        Schema::create('external_books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->string('subtitle', 250);
            $table->string('author', 100);
            $table->string('published', 100);
            $table->string('publisher', 100);
            $table->integer('pages');
            $table->longText('description');
            $table->string('isbn');
            $table->string('website');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_books');
    }
};
