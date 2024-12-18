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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_type_id')->constrained(
                 table: 'payment_types', indexName: 'fee_payment_type_id'
            );
            $table->foreignId('student_id')->constrained(
                 table: 'students', indexName: 'fee_student_id'
            );

            $table->float('amount');
            $table->date('due_date');
            $table->enum('status', ['paid', 'unpaid', 'partial']);
            $table->float('paid_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
