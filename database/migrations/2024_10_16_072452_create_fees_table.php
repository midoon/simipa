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
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('student_id')->references('id')->on('students');
            $table->float('amount');
            $table->date('due_date');
            $table->enum('status', ['paid', 'unpaid', 'partial']);
            $table->float('remaining_amount');
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
