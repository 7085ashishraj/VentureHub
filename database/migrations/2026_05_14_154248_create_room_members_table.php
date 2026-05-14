<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venture_room_id')->constrained('venture_rooms')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('role')->default('member'); // admin, member
            $table->timestamps();
            
            $table->unique(['venture_room_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_members');
    }
};
