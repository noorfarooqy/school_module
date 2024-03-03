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
        Schema::create('scm_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner')->references('id')->on('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('slogan')->nullable();
            $table->string('type')->default('Day');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('principle')->nullable();
            $table->string('signature_path')->nullable();
            $table->string('logo')->nullable();
            $table->string('license')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_details');
    }
};
