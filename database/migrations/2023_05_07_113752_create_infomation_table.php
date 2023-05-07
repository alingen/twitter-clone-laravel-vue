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
        Schema::create('infomations', function (Blueprint $table) {
            $table->id();
            $table->string('user_id_from');
            $table->string('tweet_id');
            $table->string('infomation_type');
            $table->string('infomation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infomation');
    }
};
