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
        Schema::table('inscriptions', function (Blueprint $table) {
            $table->string('family_name')->nullable()->change();
            $table->string('contry')->nullable()->change();
            $table->string('age_group')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('level')->nullable()->change();
            $table->json('availability')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            //
        });
    }
};
