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
        Schema::create('message_client_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jan')->default(0);
            $table->unsignedBigInteger('feb')->default(0);
            $table->unsignedBigInteger('mar')->default(0);
            $table->unsignedBigInteger('apr')->default(0);
            $table->unsignedBigInteger('may')->default(0);
            $table->unsignedBigInteger('jun')->default(0);
            $table->unsignedBigInteger('jul')->default(0);
            $table->unsignedBigInteger('aug')->default(0);
            $table->unsignedBigInteger('sep')->default(0);
            $table->unsignedBigInteger('oct')->default(0);
            $table->unsignedBigInteger('nov')->default(0);
            $table->unsignedBigInteger('dec')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_reports');
    }
};
