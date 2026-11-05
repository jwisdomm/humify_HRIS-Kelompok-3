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
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->char('employee_id', 36);
            $table->unsignedInteger('leave_type_id');
            $table->smallInteger('year');
            $table->decimal('total_days', 5, 1)->default(0);
            $table->decimal('used_days', 5, 1)->default(0);
            $table->decimal('remaining_days', 5, 1)->storedAs('total_days - used_days');

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['employee_id', 'leave_type_id', 'year'], 'uq_leave_balance_employee_type_year');

            $table->foreign('employee_id', 'fk_leave_balances_employee')
                ->references('id')
                ->on('employees')
                ->cascadeOnDelete();

            $table->foreign('leave_type_id', 'fk_leave_balances_type')
                ->references('id')
                ->on('leave_types')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};
