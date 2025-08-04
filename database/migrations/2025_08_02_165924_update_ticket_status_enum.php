<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // First, update any existing status values that don't match
            DB::statement("UPDATE tickets SET status = 'open' WHERE status IN ('assigned', 'pending')");
            DB::statement("UPDATE tickets SET status = 'closed' WHERE status IN ('accepted', 'resolved')");
            DB::statement("UPDATE tickets SET status = 'on_hold' WHERE status = 'rejected'");
            
            // Drop the old column and recreate with new enum values
            $table->dropColumn('status');
        });
        
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('status', ['open', 'in_progress', 'closed', 'on_hold'])->default('open');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('status', ['open', 'assigned', 'accepted', 'rejected', 'resolved'])->default('open');
        });
    }
};
