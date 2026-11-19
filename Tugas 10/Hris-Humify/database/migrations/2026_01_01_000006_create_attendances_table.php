<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->char('employee_id', 36);
            $table->unsignedInteger('shift_id')->nullable();

            $table->date('attendance_date');

            $table->dateTime('check_in_time')->nullable();
            $table->double('check_in_lat')->nullable();
            $table->double('check_in_lng')->nullable();
            $table->text('check_in_photo_url')->nullable();
            $table->boolean('check_in_face_verified')->nullable();
            $table->decimal('check_in_face_score', 5, 2)->nullable();

            $table->dateTime('check_out_time')->nullable();
            $table->double('check_out_lat')->nullable();
            $table->double('check_out_lng')->nullable();
            $table->text('check_out_photo_url')->nullable();
            $table->boolean('check_out_face_verified')->nullable();
            $table->decimal('check_out_face_score', 5, 2)->nullable();

            $table->enum('status', [
                'hadir', 'terlambat', 'pulang_cepat',
                'izin', 'sakit', 'cuti', 'alpha', 'libur',
            ])->default('hadir');
            $table->integer('late_minutes')->default(0);
            $table->integer('early_leave_minutes')->default(0);
            $table->integer('work_minutes')->nullable();
            $table->text('notes')->nullable();

            $table->enum('review_status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->char('reviewed_by', 36)->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->text('review_note')->nullable();

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['employee_id', 'attendance_date'], 'uq_attendance_employee_date');

            $table->foreign('employee_id', 'fk_attendance_employee')
                ->references('id')
                ->on('employees')
                ->cascadeOnDelete();

            $table->foreign('shift_id', 'fk_attendance_shift')
                ->references('id')
                ->on('work_shifts')
                ->nullOnDelete();

            $table->foreign('reviewed_by', 'fk_attendance_reviewer')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->index('attendance_date', 'idx_attendances_date');
            $table->index(['employee_id', 'attendance_date'], 'idx_attendances_employee_date');
            $table->index('status', 'idx_attendances_status');
            $table->index(['review_status', 'attendance_date'], 'idx_attendances_pending_review');
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE attendances ADD CONSTRAINT chk_attendance_checkout CHECK (check_out_time IS NULL OR check_in_time IS NULL OR check_out_time > check_in_time)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
