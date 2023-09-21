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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('message_language_id');
            $table->text('content');
            $table->text('notes')->nullable();
            $table->unsignedDecimal('single_message_cost');
            $table->unsignedDecimal('total_cost');
            $table->integer('number_of_segments');
            $table->integer('number_of_recipients');
            $table->timestamp('scheduled_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};