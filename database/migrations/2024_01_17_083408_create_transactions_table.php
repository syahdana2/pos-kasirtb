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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // $table->string('customer_id');
            $table->string('employee_id');
            $table->string('kode_invoice');
            $table->string('additional_cost');
            $table->string('subtotal');
            // $table->string('status_transaction');
            $table->string('note');
            $table->string('pay');
            $table->string('change');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
