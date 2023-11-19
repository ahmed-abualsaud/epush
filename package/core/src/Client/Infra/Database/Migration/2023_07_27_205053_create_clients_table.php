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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('business_field_id');
            $table->string('company_name')->unique();
            $table->string('religion');
            $table->decimal('balance', 20, 2, true)->default(0);
            $table->boolean('use_api_key')->default(false);
            $table->text('api_key')->nullable();
            $table->boolean('use_ip_address')->default(true);
            $table->text('ip_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
