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
        Schema::create('handlers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('handle_group_id');
            $table->string('name');
            $table->string('endpoint');
            $table->text('response_attributes')->nullable();
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(false);
            $table->timestamps();

            $table->foreign('handle_group_id')->references('id')->on('handle_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handlers');
    }
};
