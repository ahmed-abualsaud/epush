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
        Schema::create('message_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->unique();
            $table->string('saved')->default(false);
            $table->unsignedBigInteger('number_of_recipients')->default(0);
            $table->unsignedBigInteger('valid')->default(0);
            $table->unsignedBigInteger('unknown')->default(0);
            $table->unsignedBigInteger('inactive')->default(0);
            $table->unsignedBigInteger('doublication')->default(0);
            $table->json('operators')->nullable();
            $table->string('first_n')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_groups');
    }
};
