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
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade'); // Foreign key to authors
            $table->string('isbn')->unique(); 
            $table->string('title');
            $table->text('description')->nullable()->default(null);
            $table->integer('publication_year')->nullable()->default(null);
            $table->string('publisher')->nullable()->default(null);
            $table->integer('page_count')->nullable()->default(null);
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
