<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lean_canvases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venture_room_id')->constrained('venture_rooms')->cascadeOnDelete();
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('key_metrics')->nullable();
            $table->text('value_proposition')->nullable();
            $table->text('unfair_advantage')->nullable();
            $table->text('channels')->nullable();
            $table->text('customer_segments')->nullable();
            $table->text('cost_structure')->nullable();
            $table->text('revenue_streams')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lean_canvases');
    }
};
