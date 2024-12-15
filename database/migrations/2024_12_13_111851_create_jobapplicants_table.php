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
        Schema::create('jobapplicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobs_id')->constrained('jobapplications')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('image')->nullable();
            $table->string('name')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('skill')->nullable();
            $table->string('last_year_education')->nullable();
            $table->string('last_level_education')->nullable();
            $table->string('last_education')->nullable();
            $table->string('last_year_position')->nullable();
            $table->string('last_level_position')->nullable();
            $table->string('last_company')->nullable();
            $table->text('experience')->nullable();
            $table->unsignedInteger('salary')->nullable();
            $table->enum('on_working', ['yes', 'no'])->nullable();
            $table->string('cv')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobapplicants');
    }
};
