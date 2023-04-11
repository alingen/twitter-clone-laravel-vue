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
        Schema::table('users', function (Blueprint $table) {
            $table->string('introduction')->default("");
            $table->boolean('isdeleted')->default(false)->nullable(false);
            $table->string('year')->nullable(false);
            $table->string('month')->nullable(false);
            $table->string('day')->nullable(false);
            $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('introduction');
            $table->dropColumn('isdeleted');
            $table->dropColumn('year');
            $table->dropColumn('month');
            $table->dropColumn('day');
            $table->dropColumn('phone');
        });
    }
};
