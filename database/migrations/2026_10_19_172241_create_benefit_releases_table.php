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
        Schema::create('benefit_releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('senior_id')->constrained('seniors')->onDelete('cascade');
            $table->string('benefit_type');
            $table->decimal('amount', 10, 2);
            $table->date('release_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefit_releases');
    }
};