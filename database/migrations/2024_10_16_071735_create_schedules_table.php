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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained(
                 table: 'groups', indexName: 'schedule_group_id'
            );
            $table->foreignId('subject_id')->constrained(
                 table: 'subjects', indexName: 'schedule_subject_id'
            );
            $table->foreignId('teacher_id')->constrained(
                 table: 'teachers', indexName: 'schedule_teacher_id'
            );
            $table->foreignId('room_id')->constrained(
                 table: 'rooms', indexName: 'schedule_room_id'
            );
            $table->enum('day_of_week',['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabut', 'minggu']);
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
