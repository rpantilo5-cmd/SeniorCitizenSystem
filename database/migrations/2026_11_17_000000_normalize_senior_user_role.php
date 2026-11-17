<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('role', 'senior_user')
            ->update(['role' => 'resident']);
    }

    public function down(): void
    {
        // Keep resident assignments intact when rolling back this data migration.
    }
};
