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
        Schema::create('scm_school_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school')->references('id')->on('scm_schools')->cascadeOnDelete();
            $table->string('branch');
            $table->string('address')->nullable();
            $table->string('manager')->nullable();
            $table->string('signature')->nullable();
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
