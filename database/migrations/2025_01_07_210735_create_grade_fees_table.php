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
        Schema::create('grade_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_type_id')->constrained(
                 table: 'payment_types', indexName: 'grade_fee_payment_type_id'
            );
            $table->foreignId('grade_id')->constrained(
                 table: 'grades', indexName: 'grade_fee_grade_id'
            );
            $table->float('amount');
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_fees');
    }
};
