<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->boolean('cv_required');
            $table->boolean('cover_letter_required');
            $table->string('location');
            $table->unsignedBigInteger('min_salary');
            $table->unsignedBigInteger('max_salary');
            $table->string('job_type');
            $table->timestampTz('expires_at', precision: 0);
            $table->foreignId('company_id')->constrained('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
