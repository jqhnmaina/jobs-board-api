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
        // TODO add notice period
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('introduction');
            $table->string('cover_letter_path');
            $table->string('cv_path');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('job_posting_id')->constrained('job_postings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
