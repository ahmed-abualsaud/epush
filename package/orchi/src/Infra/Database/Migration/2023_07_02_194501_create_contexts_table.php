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
        Schema::create('contexts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('name');
            $table->boolean('online')->default(false);
            $table->boolean('enabled')->default(false);
            $table->unsignedInteger('num_of_handle_groups')->default(0);
            $table->unsignedInteger('num_of_enabled_handle_groups')->default(0);
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('app_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contexts');
    }
};
