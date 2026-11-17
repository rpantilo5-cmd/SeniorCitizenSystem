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
    Schema::create('seniors', function (Blueprint $table) {
        $table->id();
        $table->string('osca_id')->unique(); // <-- IPAG-ADD DIRI SA TAAS SA FIRST NAME
        $table->string('first_name');
        $table->string('last_name');
        $table->date('birthdate');
        $table->string('contact_number')->nullable();
        $table->string('barangay')->default('Barangay Anomar');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seniors');
    }
};
