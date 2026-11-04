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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->char('employee_id', 36);
            $table->unsignedInteger('leave_type_id');

            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_days', 5, 1);
            $table->text('reason')->nullable();
            $table->text('attachment_url')->nullable();

            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'dibatalkan'])->default('pending');
            $table->char('approved_by', 36)->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('employee_id', 'fk_leave_requests_employee')
                ->references('id')
                ->on('employees')
                ->cascadeOnDelete();

            $table->foreign('leave_type_id', 'fk_leave_requests_type')
                ->references('id')
                ->on('leave_types')
                ->restrictOnDelete();

            $table->foreign('approved_by', 'fk_leave_requests_approver')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->index(['employee_id', 'status'], 'idx_leave_requests_employee');
            $table->index(['start_date', 'end_date'], 'idx_leave_requests_dates');
        });

        DB::statement('ALTER TABLE leave_requests ADD CONSTRAINT chk_leave_request_dates CHECK (end_date >= start_date)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};

