<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('type')->nullable(); // Networking, Pitch, Workshop
            $table->foreignId('venture_room_id')->nullable()->constrained('venture_rooms')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['venture_room_id']);
            $table->dropColumn(['type', 'venture_room_id']);
        });
    }
};
