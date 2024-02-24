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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('message_language_id');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('length')->default(0);
            $table->text('notes')->nullable();
            $table->boolean('approved')->default(false);
            $table->unsignedDecimal('single_message_cost')->nullable();
            $table->unsignedDecimal('total_cost')->nullable();
            $table->integer('number_of_segments')->nullable();
            $table->integer('number_of_recipients')->nullable();
            $table->timestamp('scheduled_at')->useCurrent()->nullable();
            $table->boolean('sent')->default(false);
            $table->boolean('draft')->default(false);
            $table->ipAddress('sender_ip')->nullable();
            $table->string('message_type')->nullable();
            $table->string('send_type')->default('Custom Messages');
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
