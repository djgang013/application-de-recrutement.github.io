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
        Schema::table('cover_letters', function (Blueprint $table) {
            $table->text('content')->nullable(); // Adds the content column (text type)
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cover_letters', function (Blueprint $table) {
            $table->dropColumn('content'); // Drops the content column if the migration is rolled back
        });
    }
};
