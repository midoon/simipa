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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_id')->constrained(
                 table: 'fees', indexName: 'payment_fee_id'
            )->onDelete('cascade');
            $table->foreignId('student_id')->constrained(
                 table: 'students', indexName: 'payment_student_id'
            )->onDelete('cascade');
            $table->float('amount');
            $table->date('payment_date');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
