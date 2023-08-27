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
            $table->string('title');
            $table->integer('published_at');
            $table->integer('age');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->cascadeOnDelete(); //kada obrisemo autora, da obrise i referencu u Books tabeli
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete(); //kada obrisemo kategoriju, da obrise i referencu u Books tabeli
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
