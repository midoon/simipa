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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained(
                 table: 'students', indexName: 'presence_student_id'
            );
            $table->foreignId('category_id')->constrained(
                 table: 'presence_categories', indexName: 'presence_presence_category_id'
            );
            $table->foreignId('group_id')->constrained(
                 table: 'groups', indexName: 'presence_group_id'
            );
            $table->date('day');
            $table->enum('status', ['hadir', 'sakit', 'ijin', 'alpha']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
