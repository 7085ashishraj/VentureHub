<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sweat_equity_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venture_room_id')->constrained('venture_rooms')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->integer('credits_offered')->default(0);
            $table->enum('status', ['open', 'assigned', 'completed'])->default('open');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sweat_equity_tasks');
    }
};
