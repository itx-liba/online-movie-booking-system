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
        Schema::create('movie_shows', function (Blueprint $table) {
    $table->id();
    $table->foreignId('movie_id')->constrained()->onDelete('cascade');
    $table->foreignId('theater_id')->constrained()->onDelete('cascade');
    $table->date('show_date');
    $table->time('show_time');
    $table->decimal('gold_rate', 8, 2);
    $table->decimal('platinum_rate', 8, 2);
    $table->decimal('box_rate', 8, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_shows');
    }
};
