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
        Schema::create('handle_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('context_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(false);
            $table->unsignedInteger('num_of_handlers')->default(0);
            $table->unsignedInteger('num_of_enabled_handlers')->default(0);
            $table->timestamps();

            $table->foreign('context_id')->references('id')->on('contexts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handle_groups');
    }
};
