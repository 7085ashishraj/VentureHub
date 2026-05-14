<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_endorsements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('endorser_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('endorsee_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['endorser_id', 'endorsee_id', 'skill_id'], 'unique_endorsement');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_endorsements');
    }
};
