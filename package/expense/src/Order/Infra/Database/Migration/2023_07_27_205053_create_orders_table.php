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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pricelist_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->boolean('deduct')->default(false);
            $table->unsignedDecimal('credit', 20, 2);
            $table->string('status')->default('Pending'); //Pending, Paid
            $table->timestamp('collection_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
