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
        Schema::table('usages', function (Blueprint $table) {
            $table->string('period')->default('daily'); // daily, weekly, monthly, yearly
        });
    }

    public function down(): void
    {
        Schema::table('usages', function (Blueprint $table) {
            $table->dropColumn('period');
        });
    }
};
