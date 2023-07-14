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
        Schema::create('app_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->ipAddress();
            $table->string('lookup_type');
            $table->string('lookup_endpoint');
            $table->text('description')->nullable();
            $table->boolean('online')->default(false);
            $table->boolean('enabled')->default(false);
            $table->unsignedInteger('num_of_contexts')->default(0);
            $table->unsignedInteger('num_of_online_contexts')->default(0);
            $table->unsignedInteger('num_of_enabled_contexts')->default(0);
            $table->timestamps();

            $table->index('lookup_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_services');
    }
};
